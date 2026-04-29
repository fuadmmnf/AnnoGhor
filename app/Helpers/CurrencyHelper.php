<?php

namespace App\Helpers;

use App\Models\CurrencySetting;

class CurrencyHelper
{
    public static function formatPrice($price, $currency = null)
    {
        $activeCurrency = session('selected_currency');
        $settings = CurrencySetting::getActive();
        
        if (!$currency) {
            $currency = $activeCurrency ?? $settings->primary_currency;
        }
        
        // Convert price if needed
        if ($currency != $settings->primary_currency && $settings->currency_mode === 'double') {
            $price = $settings->convertPrice($price);
        }
        
        $symbol = CurrencySetting::getCurrencySymbol($currency);
        return $symbol . number_format($price, 2);
    }
    
    public static function getAvailableCurrencies()
    {
        $settings = CurrencySetting::getActive();
        $currencies = [$settings->primary_currency];
        
        if ($settings->currency_mode === 'double' && $settings->secondary_currency) {
            $currencies[] = $settings->secondary_currency;
        }
        
        return $currencies;
    }
}