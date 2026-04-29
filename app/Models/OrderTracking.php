<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'status',
        'description',
        'location',
        'tracking_date',
    ];

    protected $casts = [
        'tracking_date' => 'datetime',
    ];

    // Relationship
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}