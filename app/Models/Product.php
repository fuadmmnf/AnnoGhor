<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    protected static function booted(): void
    {
        static::saving(function (self $product): void {
            if (blank($product->slug) && filled($product->name)) {
                $product->slug = static::generateUniqueSlug($product->name, $product->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name) ?: 'product';
        $slug = $baseSlug;
        $counter = 1;

        while (static::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function detailsRouteParams(): ?array
    {
        $categorySlug = optional($this->category)->slug;
        $subcategorySlug = optional($this->subcategory)->slug;

        if (blank($this->slug) || blank($categorySlug) || blank($subcategorySlug)) {
            return null;
        }

        return [
            'cat_slug' => $categorySlug,
            'subcat_slug' => $subcategorySlug,
            'prod_slug' => $this->slug,
        ];
    }

    public function getDetailsUrlAttribute(): string
    {
        $params = $this->detailsRouteParams();

        return $params
            ? route('product-details', $params)
            : route('product-details.legacy', ['product' => $this->id]);
    }

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

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function stockHistories()
    {
        return $this->hasMany(StockHistory::class);
    }
}
