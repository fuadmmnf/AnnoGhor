<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

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

        return view('admin.dashboard', compact(
            'totalSales',
            'totalIncome',
            'paidOrders',
            'totalVisitors',
            'recentOrders',
            'revenue',
            'profit'
        ));
    }

    
}
