<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
     * Display product details for users
     */
    public function showDetails(string $cat_slug, string $subcat_slug, string $prod_slug)
    {
        $product = Product::with(['category', 'subcategory', 'images'])
            ->where('slug', $prod_slug)
            ->firstOrFail();

        if (!$product->category || !$product->subcategory) {
            abort(404);
        }

        $expectedParams = $product->detailsRouteParams();
        if ($expectedParams && (
            $expectedParams['cat_slug'] !== $cat_slug ||
            $expectedParams['subcat_slug'] !== $subcat_slug
        )) {
            return redirect()->route('product-details', $expectedParams);
        }

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['category', 'subcategory', 'images'])
            ->limit(4)
            ->get();
        
        $productsReviews = Review::where('product_id', $product->id)->where('is_active', 1)->latest()->get();  
          
        return view('product-details', compact('product', 'relatedProducts', 'productsReviews'));
    }

    public function showDetailsById(Product $product): RedirectResponse|\Illuminate\View\View
    {
        $product->loadMissing(['category', 'subcategory', 'images']);

        $canonicalParams = $product->detailsRouteParams();
        if ($canonicalParams) {
            return redirect()->route('product-details', $canonicalParams);
        }

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['category', 'subcategory', 'images'])
            ->limit(4)
            ->get();

        return view('product-details', compact('product', 'relatedProducts'));
    }

    /**
     * Display all products for shop page
     */
    public function shop(Request $request)
    {
        $query = Product::with(['category', 'subcategory', 'images']);

    // Keep backward compatibility: old URLs may still use `category_id`.
    $rawCategoryFilter = $request->input('category', $request->input('category_id'));
    $categoryIds = collect(is_array($rawCategoryFilter) ? $rawCategoryFilter : explode(',', (string) $rawCategoryFilter))
        ->filter(fn ($id) => is_numeric($id))
        ->map(fn ($id) => (int) $id)
        ->unique()
        ->values();

    $activeSubcategories = collect();

    // সার্চ ফিল্টার...
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('product_code', 'like', '%' . $request->search . '%');
        });
    }

    // ২. ক্যাটাগরি ফিল্টার
    if ($categoryIds->isNotEmpty()) {
        $query->whereIn('category_id', $categoryIds->all());
        $activeSubcategories = Subcategory::whereIn('category_id', $categoryIds->all())->get();
    }

    if ($request->filled('subcategory') && is_numeric($request->subcategory)) {
        $query->where('subcategory_id', (int) $request->subcategory);

        if ($activeSubcategories->isEmpty()) {
            $selectedSubcategory = Subcategory::find((int) $request->subcategory);
            if ($selectedSubcategory) {
                $activeSubcategories = Subcategory::where('category_id', $selectedSubcategory->category_id)->get();
            }
        }
    }

    if ($request->filled('price_range') && str_contains((string) $request->price_range, '-')) {
        [$min, $max] = explode('-', (string) $request->price_range, 2);
        $min = is_numeric($min) ? (float) $min : null;
        $max = is_numeric($max) ? (float) $max : null;

        if ($min !== null && $max !== null) {
            $query->whereBetween('regular_price', [$min, $max]);
        }
    }

    switch ($request->input('sort', 'latest')) {
        case 'newest':
        case 'latest':
            $query->latest();
            break;
        case 'price_high':
            $query->orderByRaw('(CASE WHEN discount_price IS NULL OR discount_price = 0 THEN regular_price ELSE discount_price END) DESC');
            break;
        case 'price_low':
            $query->orderByRaw('(CASE WHEN discount_price IS NULL OR discount_price = 0 THEN regular_price ELSE discount_price END) ASC');
            break;
        case 'name_asc':
            $query->orderBy('name');
            break;
        case 'name_desc':
            $query->orderByDesc('name');
            break;
        default:
            $query->latest();
            break;
    }

    $products = $query->paginate(9)->withQueryString();
    $categories = Category::withCount('products')->get();

    // ৩. এখন compact ব্যবহার করলে আর এরর দিবে না
        return view('shops', compact('products', 'categories', 'activeSubcategories'));
    }


}
