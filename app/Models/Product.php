<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'product_code',
        'regular_price',
        'discount_price',
        'description',
        'height',
        'width',
        'length',
        'stock_quantity',
        'delivery_days',
        'is_featured',
        'is_trending',
        'is_banner',
        'thumbnail',
        'category_id',
        'subcategory_id',
    ];

    protected $appends = ['final_price'];
    

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

      public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->regular_price;
    }
    // App\Models\Product.php
public function carts()
{
    return $this->hasMany(Cart::class);
}
public function stockHistories() {
    return $this->hasMany(StockHistory::class);
}
    
}
