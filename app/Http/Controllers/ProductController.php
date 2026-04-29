<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Subcategory;

class ProductController extends Controller
{
    /**
     * Display product details for users
     */
    public function showDetails($cat_slug, $subcat_slug, $prod_slug)
{
    // স্লাগ অনুযায়ী প্রোডাক্ট খুঁজে বের করা
    $product = Product::with(['category', 'subcategory', 'images'])
        ->where('slug', $prod_slug)
        ->firstOrFail();

    // সিকিউরিটি চেক: ক্যাটাগরি ও সাবক্যাটাগরি স্লাগ ঠিক আছে কি না যাচাই করা (ঐচ্ছিক কিন্তু ভালো)
    if ($product->category->slug !== $cat_slug || $product->subcategory->slug !== $subcat_slug) {
        abort(404);
    }

    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->with(['category', 'images'])
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

    // ১. শুরুতে ভেরিয়েবলটি খালি অ্যারে বা কালেকশন হিসেবে ডিফাইন করুন
    $activeSubcategories = collect(); 

    // সার্চ ফিল্টার...
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('product_code', 'like', '%' . $request->search . '%');
        });
    }

    // ২. ক্যাটাগরি ফিল্টার
    if ($request->filled('category')) {
        $categoryIds = is_array($request->category) ? $request->category : explode(',', $request->category);
        $query->whereIn('category_id', $categoryIds);
        
        // এখানে ডাটা অ্যাসাইন হচ্ছে
        $activeSubcategories = Subcategory::whereIn('category_id', $categoryIds)->get();
    }

    // বাকি ফিল্টার এবং সর্টিং কোড আগের মতোই থাকবে...
    // ... (Sorting, Pagination)

    $products = $query->paginate(9)->withQueryString();
    $categories = Category::withCount('products')->get();

    // ৩. এখন compact ব্যবহার করলে আর এরর দিবে না
    return view('shops', compact('products', 'categories', 'activeSubcategories'));
}
    

}
