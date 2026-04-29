<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\CurrencySetting;
use Symfony\Component\HttpFoundation\Response;

class ShareCurrencyData
{
    public function handle(Request $request, Closure $next): Response
    {
        $currencySettings = CurrencySetting::getActive();
        
        // ✅ ALWAYS use primary currency as default if not set in session
        if (!session()->has('selected_currency')) {
            session(['selected_currency' => $currencySettings->primary_currency]);
        }
        
        $selectedCurrency = session('selected_currency');
        
        // ✅ Build list of valid currencies
        $validCurrencies = [$currencySettings->primary_currency];
        if ($currencySettings->currency_mode === 'double' && $currencySettings->secondary_currency) {
            $validCurrencies[] = $currencySettings->secondary_currency;
        }
        
        // ✅ If selected currency is not valid anymore (settings changed), reset to primary
        if (!in_array($selectedCurrency, $validCurrencies)) {
            session(['selected_currency' => $currencySettings->primary_currency]);
            $selectedCurrency = $currencySettings->primary_currency;
        }
        
        view()->share('currencySettings', $currencySettings);
        view()->share('selectedCurrency', $selectedCurrency);
        
        return $next($request);
    }
}