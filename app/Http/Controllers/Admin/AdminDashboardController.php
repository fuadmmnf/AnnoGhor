<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Http; // 🌟 API কলের জন্য এটি যুক্ত করা হয়েছে
use Illuminate\Support\Facades\Log;  // 🌟 এরর ট্র্যাক করার জন্য

class AdminDashboardController extends Controller
{
    public function index()
    {

        $totalSales = Order::count();

        $totalIncome = Order::where('payment_status', 'Success')
            ->sum('total_amount');

        $paidOrders = Order::where('payment_status', 'Success')->count();

        $totalVisitors = User::where('role', 'user')->count();

        $recentOrders = Order::with(['user', 'orderItems.product'])
            ->latest()          
            ->take(5)         
            ->get();

        $revenue = $totalIncome;
        $profit  = $totalIncome * 0.7; // example profit logic

        // 🌟 STEADFAST COURIER API: Current Balance Fetch
        $steadfastBalance = 0;
        
        try {
            $response = Http::withHeaders([
                'Api-Key'    => env('STEADFAST_API_KEY'),
                'Secret-Key' => env('STEADFAST_SECRET_KEY'),
            ])->get(env('STEADFAST_BASE_URL') . '/get_balance'); // ডকুমেন্টেশন অনুযায়ী ব্যালেন্স এপিআই

            if ($response->successful()) {
                $result = $response->json();
                
                // স্ট্যাটাস 200 হলে ব্যালেন্স আপডেট হবে
                if (isset($result['status']) && $result['status'] == 200) {
                    $steadfastBalance = $result['current_balance'] ?? 0;
                }
            }
        } catch (\Exception $e) {
            // ইন্টারনেট সমস্যা বা API ডাউন থাকলে যাতে আপনার ড্যাশবোর্ড ক্র্যাশ না করে
            Log::error('Steadfast Balance Fetch Error: ' . $e->getMessage());
        }

        return view('admin.dashboard', compact(
            'totalSales',
            'totalIncome',
            'paidOrders',
            'totalVisitors',
            'recentOrders',
            'revenue',
            'profit',
            'steadfastBalance' // 🌟 নতুন ব্যালেন্স ভ্যারিয়েবলটি ভিউতে পাঠানো হলো
        ));
    }
}