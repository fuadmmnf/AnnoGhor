<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
    'site_logo',
    'site_phone',
    'site_email',
    'site_address',
    // নতুন এই কলামগুলো যুক্ত করুন
    'facebook_url',
    'instagram_url',
    'linkedin_url',
    'twitter_url',
];

    public static function getSettings()
    {
        return self::first();
    }
}