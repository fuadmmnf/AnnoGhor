<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'subtotal',
        'shipping_cost',
        'tax',
        'total_amount',
        'payment_method',
        'payment_status',
        'order_status',
        'order_notes',
        'country',
        'city',
        'postcode',
        'street_address',
        'phone',
        'email',
        'expected_delivery_date',
    ];

    protected $casts = [
        'expected_delivery_date' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function trackings()
    {
        return $this->hasMany(OrderTracking::class);
    }

    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Helper method to get full shipping address
    public function getFullAddressAttribute()
    {
        return trim(implode(', ', array_filter([
            $this->street_address,
            $this->city,
            $this->postcode,
            $this->country
        ])));
    }
}