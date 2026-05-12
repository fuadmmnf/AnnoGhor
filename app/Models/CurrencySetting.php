<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencySetting extends Model
{
    protected $fillable = [
        'currency_mode',
        'primary_currency',
        'secondary_currency',
        'conversion_rate',
        'is_active'
    ];

    protected $casts = [
        'conversion_rate' => 'decimal:4',
        'is_active' => 'boolean'
    ];

    // Get active currency setting
    public static function getActive()
    {
        $setting = self::where('is_active', true)->first();

        if (!$setting) {
            return self::getDefault();
        }

        return $setting;
    }

    // Default currency setting (fallback only)
    public static function getDefault()
    {
        return (object) [
            'currency_mode' => 'single',
            'primary_currency' => 'USD',
            'secondary_currency' => null,
            'conversion_rate' => null,
            'is_active' => true
        ];
    }

    // Convert price from primary to secondary currency
    public function convertPrice($price)
    {
        if ($this->currency_mode === 'double' && $this->conversion_rate) {
            return round($price * $this->conversion_rate, 2);
        }
        return $price;
    }

    // Get currency symbol
    public static function getCurrencySymbol($currency)
    {
        $symbols = [
            'USD' => '৳',
            'BDT' => '৳'
        ];
        return $symbols[$currency] ?? $currency;
    }
}
