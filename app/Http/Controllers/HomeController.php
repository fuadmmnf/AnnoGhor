<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Models\Headline;
use App\Models\Category; // Ei line-ti missing chilo
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
{
    // Banner Products
    $bannerProducts = Product::where('is_banner', 1)->latest()->take(3)->get();

    // Featured Categories fetch kora (Eta add korun)
    // Ghorerbazar-er moto section-er jonno categories lagbe
    
    $categories = Category::latest()->take(12)->get();

    // Trending Products
    $trendingProducts = Product::with(['category', 'subcategory'])
        ->where('is_trending', 1)
        ->latest()
        ->take(8)
        ->get();


    // আমরা সেইসব ক্যাটাগরি আনবো যেগুলোর প্রোডাক্ট আছে
    // সাথে প্রতিটি ক্যাটাগরির লেটেস্ট ৫টি প্রোডাক্ট লোড করবো
    $categoryProducts = Category::with(['products' => function($query) {
        $query->latest()->take(5);
    }])->get();

    // Featured Products
    $featuredProducts = Product::with(['category', 'subcategory'])
        ->where('is_featured', 1)
        ->latest()
        ->take(8)
        ->get();

    $reviews = Review::where('is_active', 1)->latest()->get();
    $headlines = Headline::latest()->get();

    // স্লাইডারের ছবিগুলো নিচ্ছি
    $sliderBanners = Banner::where('type', 'slider')
                           ->where('status', 1)
                           ->latest()
                           ->get();

    // ডান পাশের ১টি স্ট্যাটিক ছবি নিচ্ছি
    $staticBanner = Banner::where('type', 'static_side')
                          ->where('status', 1)
                          ->first();

    // Compact-e 'categories' pass korun
    return view('home', compact(
        'categoryProducts',
        'bannerProducts', 
        'featuredProducts', 
        'trendingProducts', 
        'reviews', 
        'headlines', 
        'categories',
        'sliderBanners', 
        'staticBanner'
    ));
}

    public function about()
    {
        $reviews = Review::where('is_active', 1)->latest()->get(); // Active reviews
        return view('about', compact('reviews'));
    }

    public function newArrivals()
    {
        // ১. Trending Products (সর্বোচ্চ ৮টি)
        $trendingProducts = Product::with(['category', 'subcategory'])
            ->where('is_trending', 1) // এখানে is_trending ফিল্টার হবে
            ->latest()
            ->take(8)
            ->get();
        return view('new-arrivals', compact('trendingProducts'));
    }
    public function profile()
    {
        return view('profile');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        // Update the password
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password updated successfully!');
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // শুধু নাম আপডেট হবে
        $user->update([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Profile updated successfully!');
    }
}
