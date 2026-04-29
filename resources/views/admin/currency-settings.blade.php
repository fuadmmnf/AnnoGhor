@extends('layouts.admin')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Currency Settings</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Currency Settings</div>
                    </li>
                </ul>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="wg-box">
                <form class="form-new-product form-style-1" method="POST" action="{{ route('admin.currency-settings.store') }}">
                    @csrf
                    
                    <fieldset class="name">
                        <div class="body-title">Currency Mode <span class="tf-color-1">*</span></div>
                        <div class="select flex-grow">
                            <select name="currency_mode" id="currency_mode" required>
                                <option value="">Select Currency Mode</option>
                                <option value="single" {{ old('currency_mode', $currencySetting->currency_mode ?? '') == 'single' ? 'selected' : '' }}>
                                    Single Currency
                                </option>
                                <option value="double" {{ old('currency_mode', $currencySetting->currency_mode ?? '') == 'double' ? 'selected' : '' }}>
                                    Double Currency
                                </option>
                            </select>
                        </div>
                        @error('currency_mode')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Primary Currency <span class="tf-color-1">*</span></div>
                        <div class="select flex-grow">
                            <select name="primary_currency" id="primary_currency" required>
                                <option value="">Select Primary Currency</option>
                                <option value="USD" {{ old('primary_currency', $currencySetting->primary_currency ?? '') == 'USD' ? 'selected' : '' }}>
                                    USD - US Dollar
                                </option>
                                <option value="BDT" {{ old('primary_currency', $currencySetting->primary_currency ?? '') == 'BDT' ? 'selected' : '' }}>
                                    BDT - Bangladeshi Taka
                                </option>
                            </select>
                        </div>
                        @error('primary_currency')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    <fieldset class="name" id="secondary_currency_field">
                        <div class="body-title">Secondary Currency <span class="tf-color-1">*</span></div>
                        <div class="select flex-grow">
                            <select name="secondary_currency" id="secondary_currency">
                                <option value="">Select Secondary Currency</option>
                                <option value="USD" {{ old('secondary_currency', $currencySetting->secondary_currency ?? '') == 'USD' ? 'selected' : '' }}>
                                    USD - US Dollar
                                </option>
                                <option value="BDT" {{ old('secondary_currency', $currencySetting->secondary_currency ?? '') == 'BDT' ? 'selected' : '' }}>
                                    BDT - Bangladeshi Taka
                                </option>
                            </select>
                        </div>
                        @error('secondary_currency')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    <fieldset class="name" id="conversion_rate_field">
                        <div class="body-title">Conversion Rate <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="number" step="0.0001" placeholder="Enter conversion rate" 
                               name="conversion_rate" id="conversion_rate" 
                               value="{{ old('conversion_rate', $currencySetting->conversion_rate ?? '') }}">
                        <small class="text-muted">Example: If Primary=USD, Secondary=BDT, Rate=110.5000 means 1 USD = 110.5 BDT</small>
                        @error('conversion_rate')
                        <span class="text-danger d-block">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    <div class="bot">
                        <button class="tf-button w208" type="submit">Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
#secondary_currency_field, #conversion_rate_field {
    display: none;
}
#secondary_currency_field.show, #conversion_rate_field.show {
    display: block;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const currencyMode = document.getElementById('currency_mode');
    const secondaryField = document.getElementById('secondary_currency_field');
    const conversionField = document.getElementById('conversion_rate_field');
    const secondarySelect = document.getElementById('secondary_currency');
    const conversionInput = document.getElementById('conversion_rate');

    function toggleFields() {
        if (currencyMode.value === 'double') {
            secondaryField.classList.add('show');
            conversionField.classList.add('show');
            secondarySelect.setAttribute('required', 'required');
            conversionInput.setAttribute('required', 'required');
        } else {
            secondaryField.classList.remove('show');
            conversionField.classList.remove('show');
            secondarySelect.removeAttribute('required');
            conversionInput.removeAttribute('required');
            secondarySelect.value = '';
            conversionInput.value = '';
        }
    }

    currencyMode.addEventListener('change', toggleFields);
    toggleFields(); // Initial load
});
</script>
@endsection