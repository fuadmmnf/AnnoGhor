<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Subcategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

beforeEach(function () {
    view()->share('siteSettings', new Setting());
});

it('filters products by category and subcategory query params', function () {
    $categoryA = Category::create([
        'name' => 'Category A',
        'slug' => 'category-a',
    ]);

    $categoryB = Category::create([
        'name' => 'Category B',
        'slug' => 'category-b',
    ]);

    $subA1 = Subcategory::create([
        'name' => 'Sub A1',
        'slug' => 'sub-a1',
        'category_id' => $categoryA->id,
    ]);

    $subA2 = Subcategory::create([
        'name' => 'Sub A2',
        'slug' => 'sub-a2',
        'category_id' => $categoryA->id,
    ]);

    $subB1 = Subcategory::create([
        'name' => 'Sub B1',
        'slug' => 'sub-b1',
        'category_id' => $categoryB->id,
    ]);

    Product::create([
        'name' => 'Alpha Product',
        'slug' => 'alpha-product',
        'product_code' => 'P-ALPHA',
        'regular_price' => 200,
        'discount_price' => 180,
        'category_id' => $categoryA->id,
        'subcategory_id' => $subA1->id,
    ]);

    Product::create([
        'name' => 'Beta Product',
        'slug' => 'beta-product',
        'product_code' => 'P-BETA',
        'regular_price' => 150,
        'category_id' => $categoryA->id,
        'subcategory_id' => $subA2->id,
    ]);

    Product::create([
        'name' => 'Gamma Product',
        'slug' => 'gamma-product',
        'product_code' => 'P-GAMMA',
        'regular_price' => 400,
        'category_id' => $categoryB->id,
        'subcategory_id' => $subB1->id,
    ]);

    $this->get(route('shops', ['category' => $categoryA->id]))
        ->assertOk()
        ->assertSeeText('Alpha Product')
        ->assertSeeText('Beta Product')
        ->assertDontSeeText('Gamma Product');

    $this->get(route('shops', ['subcategory' => $subA1->id]))
        ->assertOk()
        ->assertSeeText('Alpha Product')
        ->assertDontSeeText('Beta Product')
        ->assertDontSeeText('Gamma Product');
});

it('uses the shop category filter URL for featured category links on home', function () {
    $category = Category::create([
        'name' => 'Living Room',
        'slug' => 'living-room',
    ]);

    $sub = Subcategory::create([
        'name' => 'Sofas',
        'slug' => 'sofas',
        'category_id' => $category->id,
    ]);

    Product::create([
        'name' => 'Home Link Product',
        'slug' => 'home-link-product',
        'product_code' => 'P-HOME-LINK',
        'regular_price' => 999,
        'is_trending' => 1,
        'is_featured' => 1,
        'category_id' => $category->id,
        'subcategory_id' => $sub->id,
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee(route('shops', ['category' => $category->id]), false);
});

it('opens product details through legacy id route when slug data is missing', function () {
    $categoryId = DB::table('categories')->insertGetId([
        'name' => 'Legacy Category',
        'slug' => null,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $subcategoryId = DB::table('subcategories')->insertGetId([
        'name' => 'Legacy Subcategory',
        'slug' => null,
        'category_id' => $categoryId,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $productId = DB::table('products')->insertGetId([
        'name' => 'Legacy Product',
        'slug' => null,
        'product_code' => 'P-LEGACY-1',
        'regular_price' => 123,
        'discount_price' => null,
        'category_id' => $categoryId,
        'subcategory_id' => $subcategoryId,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->get(route('product-details.legacy', ['product' => $productId]))
        ->assertOk()
        ->assertSeeText('Legacy Product');
});


