<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CurrencySetting;

class CurrencyController extends Controller
{
    public function switch($currency)
    {
        $settings = CurrencySetting::getActive();
        
        // ✅ Validate currency against current settings
        $validCurrencies = [$settings->primary_currency];
        if ($settings->currency_mode === 'double' && $settings->secondary_currency) {
            $validCurrencies[] = $settings->secondary_currency;
        }
        
        if (in_array($currency, $validCurrencies)) {
            session(['selected_currency' => $currency]);
            return redirect()->back()->with('success', 'Currency switched to ' . $currency);
        }
        
        // ✅ If invalid, reset to primary
        session(['selected_currency' => $settings->primary_currency]);
        return redirect()->back()->with('error', 'Invalid currency selected. Reset to primary currency.');
    }
    
    // ✅ Optional: Reset to primary currency
    public function reset()
    {
        $settings = CurrencySetting::getActive();
        session(['selected_currency' => $settings->primary_currency]);
        return redirect()->back()->with('success', 'Currency reset to primary (' . $settings->primary_currency . ')');
    }
}