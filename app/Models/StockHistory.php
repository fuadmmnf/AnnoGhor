<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    protected $fillable = ['product_id', 'quantity_added', 'old_stock', 'new_stock'];

public function product() {
    return $this->belongsTo(Product::class);
}
}
