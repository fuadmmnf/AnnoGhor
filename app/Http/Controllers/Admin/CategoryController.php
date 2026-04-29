<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

public function index(Request $request)
{
    $perPage = $request->get('per_page', 10);
    $search = $request->get('name');

    $categories = Category::with('subcategories')
        ->withCount('products') // total products in category
        ->withSum(['products as total_sold_quantity' => function($query){
            $query->join('order_items', 'products.id', '=', 'order_items.product_id');
        }], 'order_items.quantity') // total units sold
        ->withSum(['products as total_sale_amount' => function($query){
            $query->join('order_items', 'products.id', '=', 'order_items.product_id');
        }], DB::raw('order_items.quantity * order_items.price')) // total amount
        ->when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate($perPage);

    return view('admin.category-list', compact('categories'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add-category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'category_name' => 'required|string|max:255',
        'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Validation
        'subcategories' => 'required|array',
        'subcategories.*' => 'required|string|max:255',
    ]);

    DB::beginTransaction();
    try {
        $imageName = null;
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/category'), $imageName);
        }

        $category = Category::create([
            'name' => $request->category_name,
            'image' => $imageName, // Database-e save holo
        ]);

        foreach ($request->subcategories as $sub) {
            Subcategory::create([
                'category_id' => $category->id,
                'name' => $sub,
            ]);
        }

        DB::commit();
        return redirect()->route('admin.category-list')->with('success', 'Category added successfully!');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
    }
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::with('subcategories')->findOrFail($id);
        return view('admin.edit-category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'category_name' => 'required|string|max:255',
        'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Image validation
        'subcategory_ids.*' => 'nullable|integer',
        'subcategories.*' => 'nullable|string|max:255',
        'new_subcategories.*' => 'nullable|string|max:255',
    ]);

    DB::beginTransaction();

    try {
        $category = Category::findOrFail($id);

        // 1️⃣ Image Update Logic
        if ($request->hasFile('category_image')) {
            // Purono image delete kora
            if ($category->image && file_exists(public_path('uploads/category/' . $category->image))) {
                unlink(public_path('uploads/category/' . $category->image));
            }
            
            $image = $request->file('category_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/category'), $imageName);
            $category->image = $imageName; // New image name set
        }

        // 2️⃣ Update Category Name
        $category->name = $request->category_name;
        $category->save();

        // 3️⃣ Subcategory Update & Delete Logic
        $existingSubcategoryIds = $category->subcategories->pluck('id')->toArray();
        $submittedIds = $request->subcategory_ids ?? [];

        // Existing subcategories update kora
        if ($request->has('subcategory_ids') && $request->has('subcategories')) {
            foreach ($request->subcategory_ids as $index => $subId) {
                if (isset($request->subcategories[$index])) {
                    $subcategory = Subcategory::find($subId);
                    if ($subcategory && $subcategory->category_id == $category->id) {
                        $subcategory->name = $request->subcategories[$index];
                        $subcategory->save();
                    }
                }
            }
        }

        // Bad pore jaoa subcategories delete kora
        $idsToDelete = array_diff($existingSubcategoryIds, $submittedIds);
        if (!empty($idsToDelete)) {
            Subcategory::whereIn('id', $idsToDelete)
                ->where('category_id', $category->id)
                ->delete();
        }

        // 4️⃣ New Subcategories Add kora
        if ($request->has('new_subcategories')) {
            foreach ($request->new_subcategories as $newSubName) {
                if (!empty(trim($newSubName))) {
                    Subcategory::create([
                        'category_id' => $category->id,
                        'name' => trim($newSubName),
                    ]);
                }
            }
        }

        DB::commit();

        return redirect()
            ->route('admin.category-list')
            ->with('success', 'Category and subcategories updated successfully!');

    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()
            ->withInput()
            ->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $category = Category::findOrFail($id);
            
            // Delete subcategories first
            $category->subcategories()->delete();
            
            // Delete category
            $category->delete();

            DB::commit();

            return redirect()->route('admin.category-list')
                ->with('success', 'Category and its subcategories deleted successfully.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
}