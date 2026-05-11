<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    // 'slug' টি fillable-এ অবশ্যই যোগ করবেন
    protected $fillable = ['name', 'slug', 'category_id'];

    protected static function booted(): void
    {
        static::saving(function (self $subcategory): void {
            if (blank($subcategory->slug) && filled($subcategory->name)) {
                $subcategory->slug = static::generateUniqueSlug($subcategory->name, $subcategory->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name) ?: 'subcategory';
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
