<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderItems'])
            ->when(request('name'), function ($query) {
                $query->where('order_number', 'like', '%' . request('name') . '%')
                    ->orWhere('email', 'like', '%' . request('name') . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . request('name') . '%');
                    });
            })
            ->latest()
            ->paginate(10);

        return view('admin.order-list', compact('orders'));
    }

    public function pending()
    {
        $orders = Order::with(['user', 'orderItems'])
            ->where('order_status', 'Pending')
            ->when(request('name'), function ($query) {
                $query->where('order_number', 'like', '%' . request('name') . '%')
                    ->orWhere('email', 'like', '%' . request('name') . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . request('name') . '%');
                    });
            })
            ->latest()
            ->paginate(10);

        return view('admin.order-list', compact('orders'));
    }

    public function processing()
    {
        $orders = Order::with(['user', 'orderItems'])
            ->where('order_status', 'Processing')
            ->when(request('name'), function ($query) {
                $query->where('order_number', 'like', '%' . request('name') . '%')
                    ->orWhere('email', 'like', '%' . request('name') . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . request('name') . '%');
                    });
            })
            ->latest()
            ->paginate(10);

        return view('admin.order-list', compact('orders'));
    }

    public function shipped()
    {
        $orders = Order::with(['user', 'orderItems'])
            ->where('order_status', 'Shipped')
            ->when(request('name'), function ($query) {
                $query->where('order_number', 'like', '%' . request('name') . '%')
                    ->orWhere('email', 'like', '%' . request('name') . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . request('name') . '%');
                    });
            })
            ->latest()
            ->paginate(10);

        return view('admin.order-list', compact('orders'));
    }

    public function delivered()
    {
        $orders = Order::with(['user', 'orderItems'])
            ->where('order_status', 'Delivered')
            ->when(request('name'), function ($query) {
                $query->where('order_number', 'like', '%' . request('name') . '%')
                    ->orWhere('email', 'like', '%' . request('name') . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . request('name') . '%');
                    });
            })
            ->latest()
            ->paginate(10);

        return view('admin.order-list', compact('orders'));
    }

    public function cancelled()
    {
        $orders = Order::with(['user', 'orderItems'])
            ->where('order_status', 'Cancelled')
            ->when(request('name'), function ($query) {
                $query->where('order_number', 'like', '%' . request('name') . '%')
                    ->orWhere('email', 'like', '%' . request('name') . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . request('name') . '%');
                    });
            })
            ->latest()
            ->paginate(10);

        return view('admin.order-list', compact('orders'));
    }

    // Order details
    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.product', 'trackings'])
            ->findOrFail($id);

        return view('admin.order-detail', compact('order'));
    }

    // Order tracking page
    public function tracking($id)
    {
        $order = Order::with(['orderItems.product', 'trackings' => function ($query) {
            $query->orderBy('tracking_date', 'desc');
        }])->findOrFail($id);

        return view('admin.order-tracking', compact('order'));
    }

    // Update order status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|in:Pending,Processing,Shipped,Delivered,Cancelled',
            'payment_status' => 'nullable|in:Pending,Success,Failed',
        ]);

        $order = Order::findOrFail($id);
        $order->order_status = $request->order_status;

        if ($request->payment_status) {
            $order->payment_status = $request->payment_status;
        }

        $order->save();

        // Add tracking entry when status changes
        $statusDescriptions = [
            'Pending' => 'Order is pending confirmation.',
            'Processing' => 'Order is being processed.',
            'Shipped' => 'Order has been shipped.',
            'Delivered' => 'Order has been delivered successfully.',
            'Cancelled' => 'Order has been cancelled.',
        ];

        OrderTracking::create([
            'order_id' => $order->id,
            'status' => $request->order_status,
            'description' => $statusDescriptions[$request->order_status] ?? 'Order status updated.',
            'location' => $order->city . ', ' . $order->country,
            'tracking_date' => now(),
        ]);

        return back()->with('success', 'Order status updated successfully!');
    }

    // Delete order
    public function destroy($id)
    {
        $order = Order::with(['orderItems', 'trackings'])->findOrFail($id);

        DB::beginTransaction();
        try {
            $order->orderItems()->forceDelete();
            $order->trackings()->forceDelete();

            $order->forceDelete();

            DB::commit();
            return back()->with('success', 'Order deleted successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Failed to delete order: ' . $e->getMessage());
        }
    }

    // Add manual tracking entry
    public function addTracking(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'description' => 'required|string',
            'location' => 'nullable|string',
        ]);

        OrderTracking::create([
            'order_id' => $id,
            'status' => $request->status,
            'description' => $request->description,
            'location' => $request->location,
            'tracking_date' => now(),
        ]);

        return back()->with('success', 'Tracking entry added successfully!');
    }
}
