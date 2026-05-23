<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverySetting extends Model
{
    use HasFactory;

    // টেবিলে কোন কোন কলামে ডেটা ইনসার্ট করা যাবে তা ডিফাইন করা হলো
    protected $fillable = [
        'inside_dhaka',
        'outside_dhaka',
    ];
}