<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'rank',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope for active FAQs
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    // Scope for ordered FAQs
    public function scopeOrdered($query)
    {
        return $query->orderBy('rank', 'asc');
    }
}