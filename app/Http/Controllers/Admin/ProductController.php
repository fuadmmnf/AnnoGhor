<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\StockHistory;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'subcategory']);

        // Category Filter
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Search Filter
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('product_code', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        $sort = $request->get('sort', 'latest');

        switch ($sort) {
            case 'newest':
                $query->latest();
                break;
            case 'price_high':
                $query->orderBy('discount_price', 'desc');
                break;
            case 'price_low':
                $query->orderBy('discount_price', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(10);
        $categories = \App\Models\Category::all();

        return view('admin.product-list', compact('products', 'categories'));
    }


    public function create()
    {
        $categories = Category::with('subcategories')->get();
        return view('admin.add-product', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'product_code' => 'required|string|unique:products',
            'regular_price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'delivery_days' => 'nullable|integer|min:1',
            'is_featured' => 'nullable|boolean',
            'is_trending' => 'nullable|boolean',
            'is_banner' => 'nullable|boolean',
            'description' => 'nullable|string',
            'height' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048|dimensions:max_width=2048,max_height=2048',
            'images' => 'nullable|array|max:4',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048|dimensions:max_width=2048,max_height=2048'
        ]);

        try {
            // Handle thumbnail upload
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailFile = $request->file('thumbnail');
                $thumbnailName = time() . '_' . Str::random(10) . '.' . $thumbnailFile->getClientOriginalExtension();
                $thumbnailPath = $thumbnailFile->storeAs('products/thumbnails', $thumbnailName, 'public');
            }

            // Create product
            $product = Product::create([
                'name' => $request->name,
                'product_code' => $request->product_code,
                'regular_price' => $request->regular_price,
                'discount_price' => $request->discount_price,
                'description' => $request->description,
                'stock_quantity' => $request->stock_quantity,
                'delivery_days' => $request->delivery_days,
                'is_featured' => $request->has('is_featured') ? 1 : 0,
                'is_trending' => $request->has('is_trending') ? 1 : 0,
                'is_banner' => $request->has('is_banner') ? 1 : 0,
                'height' => $request->height,
                'width' => $request->width,
                'length' => $request->length,
                'thumbnail' => $thumbnailPath,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
            ]);

            // Handle multiple images upload
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                    $imagePath = $image->storeAs('products/gallery', $imageName, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $imagePath
                    ]);
                }
            }

            return redirect()->route('admin.product-list')
                ->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error adding product: ' . $e->getMessage());
        }
    }

    public function showDetails($id)
    {
        $product = Product::with(['category', 'subcategory', 'images'])->findOrFail($id);
        return view('product-details', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::with(['category', 'subcategory', 'images'])->findOrFail($id);
        $categories = Category::with('subcategories')->get();
        return view('admin.edit-product', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'product_code' => 'required|string|unique:products,product_code,' . $id,
            'regular_price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'stock_quantity' => 'required|integer|min:0',
            'delivery_days' => 'nullable|integer|min:1',
            'is_featured' => 'nullable|boolean',
            'is_trending' => 'nullable|boolean',
            'height' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048|dimensions:max_width=2048,max_height=2048',
            'images' => 'nullable|array|max:4',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048|dimensions:max_width=2048,max_height=2048'
        ]);

        try {
            // Check total images limit (existing + new)
            $existingImageCount = $product->images()->count();
            $newImageCount = $request->hasFile('images') ? count($request->file('images')) : 0;
            $totalImages = $existingImageCount + $newImageCount;

            // If total exceeds 4, return with error
            if ($totalImages > 4) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'You already have ' . $existingImageCount . ' images. You can only add ' . (4 - $existingImageCount) . ' more image(s). Maximum 4 images allowed.');
            }

            if ($request->hasFile('thumbnail')) {
                if ($product->thumbnail) {
                    Storage::disk('public')->delete($product->thumbnail);
                }

                $thumbnailFile = $request->file('thumbnail');
                $thumbnailName = time() . '_' . Str::random(10) . '.' . $thumbnailFile->getClientOriginalExtension();
                $thumbnailPath = $thumbnailFile->storeAs('products/thumbnails', $thumbnailName, 'public');

                $product->thumbnail = $thumbnailPath;
            }

            // Update product
            $product->update([
                'name' => $request->name,
                'product_code' => $request->product_code,
                'regular_price' => $request->regular_price,
                'discount_price' => $request->discount_price,
                'description' => $request->description,
                'stock_quantity' => $request->stock_quantity,
                'delivery_days' => $request->delivery_days,
                'is_featured' => $request->has('is_featured') ? 1 : 0,
                'is_trending' => $request->has('is_trending') ? 1 : 0,
                'is_banner' => $request->has('is_banner') ? 1 : 0,
                'height' => $request->height,
                'width' => $request->width,
                'length' => $request->length,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
            ]);

            // Handle multiple images upload
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                    $imagePath = $image->storeAs('products/gallery', $imageName, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $imagePath
                    ]);
                }
            }

            return redirect()->route('admin.product-list')
                ->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::with('images')->findOrFail($id);

            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->image);
                $image->delete();
            }

            $product->delete();

            return redirect()->route('admin.product-list')
                ->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }

    public function getSubcategories($categoryId)
    {
        $category = Category::with('subcategories')->findOrFail($categoryId);
        return response()->json($category->subcategories);
    }

    public function deleteImage($id)
    {
        try {
            $image = ProductImage::findOrFail($id);

            Storage::disk('public')->delete($image->image);

            $image->delete();

            return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting image'], 500);
        }
    }

    public function addStock()
    {
        $categories = Category::all();
        return view('admin.add-stock', compact('categories'));
    }

    public function getProductsBySubcategory($subcategoryId)
    {
        $products = Product::where('subcategory_id', $subcategoryId)->get();
        return response()->json($products);
    }

    public function storeStock(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock_quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $product = Product::findOrFail($request->product_id);

                $oldStock = $product->stock_quantity ?? 0;
                $addedStock = $request->stock_quantity;
                $newTotalStock = $oldStock + $addedStock;

                // ১. স্টক হিস্ট্রি টেবিলে রেকর্ড সেভ করা (Tracking এর জন্য)
                StockHistory::create([
                    'product_id' => $product->id,
                    'quantity_added' => $addedStock,
                    'old_stock' => $oldStock,
                    'new_stock' => $newTotalStock,
                ]);

                // ২. মেইন প্রোডাক্ট টেবিলে স্টক আপডেট করা
                $product->stock_quantity = $newTotalStock;
                $product->save();
            });

            return redirect()->route('admin.stock-list')->with('success', 'Stock added and logged successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
    public function stockList()
    {
        // Product, Category এবং Subcategory সহ স্টক হিস্ট্রি লোড করা হচ্ছে
        $stockHistories = \App\Models\StockHistory::with(['product.category', 'product.subcategory'])
            ->latest()
            ->paginate(10);

        return view('admin.stock-list', compact('stockHistories'));
    }
}
