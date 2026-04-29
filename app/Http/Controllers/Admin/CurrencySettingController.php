<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CurrencySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CurrencySettingController extends Controller
{
    public function index()
    {
        $currencySetting = CurrencySetting::getActive();
        return view('admin.currency-settings', compact('currencySetting'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'currency_mode' => 'required|in:single,double',
            'primary_currency' => 'required|in:USD,BDT',
            'secondary_currency' => 'nullable|required_if:currency_mode,double|in:USD,BDT|different:primary_currency',
            'conversion_rate' => 'nullable|required_if:currency_mode,double|numeric|min:0.0001|max:999999.9999'
        ], [
            'secondary_currency.required_if' => 'Secondary currency is required when double currency mode is selected.',
            'secondary_currency.different' => 'Secondary currency must be different from primary currency.',
            'conversion_rate.required_if' => 'Conversion rate is required for double currency mode.',
            'conversion_rate.min' => 'Conversion rate must be greater than 0.',
        ]);

        // Deactivate all previous settings
        CurrencySetting::query()->update(['is_active' => false]);

        // Create new active setting
        $newSetting = CurrencySetting::create([
            'currency_mode' => $validated['currency_mode'],
            'primary_currency' => $validated['primary_currency'],
            'secondary_currency' => $validated['currency_mode'] === 'double' ? $validated['secondary_currency'] : null,
            'conversion_rate' => $validated['currency_mode'] === 'double' ? $validated['conversion_rate'] : null,
            'is_active' => true
        ]);

        // ✅ Clear current user's session to apply new primary currency immediately
        session()->forget('selected_currency');
        
        // ✅ Optional: Clear all sessions (affects all users)
        // Artisan::call('session:flush');

        return redirect()->route('admin.currency-settings.index')
            ->with('success', 'Currency settings updated successfully! Primary currency (' . $validated['primary_currency'] . ') is now default.');
    }
}