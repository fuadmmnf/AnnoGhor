<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\CurrencySetting;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
{
    View::composer('*', function ($view) {

        // ✅ Current logged-in user
        $view->with('currentUser', auth()->user());

        // ✅ Default values (IMPORTANT)
        $cartCount = 0;
        $wishlistCount = 0;

        // ✅ If user logged in
        if (Auth::check()) {
            $cartCount = Cart::where('user_id', Auth::id())->count();
            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        }

        // ✅ Share counts
        $view->with('cartCount', $cartCount);
        $view->with('wishlistCount', $wishlistCount);

        // ✅ Categories (skip admin)
        if (!request()->is('admin/*')) {
            $categories = Category::withCount('products')->get();
            $view->with('categories', $categories);
        }

        // ✅ Site settings (safe share)
if (!app()->runningInConsole()) {
    $siteSettings = \App\Models\Setting::first() ?? new \App\Models\Setting(); 
    View::share('siteSettings', $siteSettings);
}

        
            // ✅ Currency settings
            if (!app()->runningInConsole()) {
                $currencySetting = CurrencySetting::first(); // get first currency setting
                view()->share('currencySetting', $currencySetting);
            }
             $setting = CurrencySetting::getActive();
             if (!Session::has('currency')) {
        Session::put('currency', $setting->primary_currency);
    }
    });
}

}
