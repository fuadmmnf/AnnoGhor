<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    // এই লাইনটি অবশ্যই থাকতে হবে, না হলে ডাটা সেভ হবে না
    protected $fillable = [
        'image',
        'type',
        'category_id',
        'link',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}