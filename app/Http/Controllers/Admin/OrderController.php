<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Log;

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

    // Update order status manually
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

    /*
    |--------------------------------------------------------------------------
    | 🚚 🌟 STEADFAST COURIER INTEGRATION METHODS 🌟
    |--------------------------------------------------------------------------
    */

    /**
     * 1. অ্যাডমিন প্যানেল থেকে সিঙ্গেলে একটি অর্ডার কুরিয়ারে পাঠানো (এবং পুনরায় পাঠানো হ্যান্ডেল করা)
     */
    public function sendSingleToSteadfast($id)
    {
        $order = Order::findOrFail($id);

        $phone = str_replace([' ', '-', '+88'], '', $order->phone);
        $customerName = $order->guest_name ?? ($order->user ? $order->user->name : 'Customer');
        $cleanNote = $order->order_notes ? trim((string) $order->order_notes) : 'Careful delivery';

        // ইনভয়েস নম্বর থেকে সব ধরনের বিশেষ ক্যারেক্টার ছেঁটে ফেলা হলো
        $baseInvoice = (string) str_replace('#', '', $order->order_number);
        $invoiceNumber = $baseInvoice;
        
        if ($order->order_status === 'Cancelled') {
            $invoiceNumber = $baseInvoice . '-R' . rand(10, 99); 
        }

        try {
            $response = Http::withHeaders([
                'Api-Key'      => env('STEADFAST_API_KEY'),
                'Secret-Key'   => env('STEADFAST_SECRET_KEY'),
                'Content-Type' => 'application/json',
            ])->post(env('STEADFAST_BASE_URL') . '/create_order', [
                'invoice'           => $invoiceNumber, 
                'recipient_name'    => substr($customerName, 0, 100),
                'recipient_phone'   => $phone,
                'recipient_address' => $order->address,
                'cod_amount'        => (float) $order->total_amount,
                'note'              => $cleanNote,
                'item_description'  => $cleanNote,
                'delivery_type'     => 0,
            ]);

            if ($response->successful()) {
                $result = $response->json();

                if (isset($result['status']) && $result['status'] == 200) {
                    
                    $trackingCode = $result['consignment']['tracking_code']
                                    ?? $result['consignment']['consignment_id']
                                    ?? null;

                    $order->order_status = 'Processing';
                    $order->tracking_code = $trackingCode;
                    $order->save(); 

                    OrderTracking::create([
                        'order_id'      => $order->id,
                        'status'        => 'Processing',
                        'description'   => 'অর্ডারটি পুনরায় নতুন ট্র্যাকিং কোডসহ স্টেডফাস্ট কুরিয়ারে পাঠানো হয়েছে। কোড: ' . $trackingCode,
                        'location'      => $order->city ?? 'Courier Hub',
                        'tracking_date' => now(),
                    ]);

                    return back()->with('success', 'অর্ডারটি সফলভাবে পুনরায় স্টেডফাস্ট কুরিয়ারে পাঠানো হয়েছে!');
                }

                return back()->with('error', 'কুরিয়ার রেসপন্স এরর: ' . ($result['message'] ?? 'তথ্য যাচাই করুন।'));
            }

            return back()->with('error', 'স্টেডফাস্ট এপিআই কানেক্ট করা যায়নি।');

        } catch (\Exception $e) {
            Log::error('Steadfast Single Push Error: ' . $e->getMessage());
            return back()->with('error', 'ব্যর্থ হয়েছে: ' . $e->getMessage());
        }
    }

   /**
     * 2. এক ক্লিকে সমস্ত পেন্ডিং অর্ডার একসাথে বাল্ক আকারে পাঠানো
     */
    public function sendBulkToSteadfast()
    {
        $orders = Order::where('order_status', 'Pending')->take(500)->get();

        if ($orders->isEmpty()) {
            return back()->with('error', 'কুরিয়ারে পাঠানোর মতো কোনো পেন্ডিং অর্ডার নেই।');
        }

        $bulkData = [];

        foreach ($orders as $order) {
            $phone = str_replace([' ', '-', '+88'], '', $order->phone);
            $customerName = $order->guest_name ?? ($order->user ? $order->user->name : 'Customer');
            $cleanNote = $order->order_notes ? trim((string) $order->order_notes) : 'Bulk Delivery';

            // 🌟 [CRITICAL FIX]: 'Invalid Input' এরর ঠেকাতে সব Key আবার ছোট হাতের (lowercase) করা হলো
            $bulkData[] = [
                'invoice'           => (string) str_replace('#', '', $order->order_number),
                'recipient_name'    => substr($customerName, 0, 100),
                'recipient_phone'   => $phone,
                'recipient_address' => $order->address ?? 'Address not provided',
                'cod_amount'        => (float) $order->total_amount,
                'note'              => $cleanNote,
                'item_description'  => $cleanNote,
                'delivery_type'     => 0,
            ];
        }

        try {
            $response = Http::withHeaders([
                'Api-Key'      => env('STEADFAST_API_KEY'),
                'Secret-Key'   => env('STEADFAST_SECRET_KEY'),
                'Content-Type' => 'application/json',
            ])->post(env('STEADFAST_BASE_URL') . '/create_order/bulk-order', [
                'data' => json_encode($bulkData),
            ]);

            if ($response->successful()) {
                $results = $response->json();

                if (is_array($results)) {
                    foreach ($results as $result) {
                        if (isset($result['status']) && $result['status'] === 'success') {
                            
                            $bulkOrder = Order::where('order_number', $result['invoice'])
                                              ->orWhere('order_number', '#' . $result['invoice'])
                                              ->first();
                            
                            if ($bulkOrder) {
                                $bulkTrackingCode = $result['tracking_code'] ?? $result['consignment_id'] ?? null;
                                
                                $bulkOrder->order_status = 'Processing';
                                $bulkOrder->tracking_code = $bulkTrackingCode;
                                $bulkOrder->save(); 
                                
                                OrderTracking::create([
                                    'order_id'      => $bulkOrder->id,
                                    'status'        => 'Processing',
                                    'description'   => 'অর্ডারটি বাল্ক বুকিংয়ের মাধ্যমে স্টেডফাস্ট কুরিয়ারে পাঠানো হয়েছে। ট্র্যাকিং কোড: ' . $bulkTrackingCode,
                                    'location'      => $bulkOrder->city ?? 'Courier Hub',
                                    'tracking_date' => now(),
                                ]);
                            }
                        }
                    }
                    return back()->with('success', 'পেন্ডিং অর্ডারগুলো সফলভাবে বাল্ক আকারে কুরিয়ারে পাঠানো হয়েছে!');
                }
            }

            return back()->with('error', 'বাল্ক অর্ডার প্রসেসিং ব্যর্থ হয়েছে বা কুরিয়ার থেকে রেসপন্স মেলেনি।');

        } catch (\Exception $e) {
            Log::error('Steadfast Bulk Push Error: ' . $e->getMessage());
            return back()->with('error', 'ব্যর্থ হয়েছে: ' . $e->getMessage());
        }
    }

    /**
     * 3. স্টেডফাস্ট কুরিয়ার থেকে লাইভ ডেলিভারি স্ট্যাটাস এনে সিস্টেমে আপডেট করা
     */
    public function syncSteadfastStatus($id)
    {
        $order = Order::findOrFail($id);

        if (!$order->tracking_code) {
            return back()->with('error', 'এই অর্ডারের কোনো কুরিয়ার ট্র্যাকিং কোড নেই।');
        }

        try {
            $response = Http::withHeaders([
                'Api-Key'    => env('STEADFAST_API_KEY'),
                'Secret-Key' => env('STEADFAST_SECRET_KEY'),
            ])->get(env('STEADFAST_BASE_URL') . '/status_by_invoice/' . str_replace('#', '', $order->order_number));

            if ($response->successful()) {
                $result = $response->json();

                // যদি কুরিয়ারে ডাটা না থাকে বা স্ট্যাটাস 200 না হয়
                if (!isset($result['status']) || $result['status'] != 200 || empty($result['delivery_status']) || $result['delivery_status'] === 'unknown') {
                    
                    $order->order_status = 'Cancelled';
                    $order->save(); 

                    OrderTracking::create([
                        'order_id'      => $order->id,
                        'status'        => 'Cancelled',
                        'description'   => 'অর্ডারটি কুরিয়ার প্যানেল থেকে বাতিল, ডিলিট বা মুছে ফেলা হয়েছে।', 
                        'location'      => $order->city ?? 'Courier Hub',
                        'tracking_date' => now(),
                    ]);

                    return back()->with('success', 'কুরিয়ার প্যানেলে অর্ডারটি না থাকায় আপনার সিস্টেমে এটি "Cancelled" করা হয়েছে।');
                }

                $courierStatus = strtolower(trim($result['delivery_status']));

                // 🌟 [FIX: Page 9] অফিসিয়াল স্ট্যাটাস অনুযায়ী ক্যানসেলড কন্ডিশন
                if (in_array($courierStatus, ['cancelled_approval_pending', 'unknown_approval_pending', 'cancelled'])) {
                    
                    $order->order_status = 'Cancelled';
                    $order->save(); 

                    OrderTracking::create([
                        'order_id'      => $order->id,
                        'status'        => 'Cancelled',
                        'description'   => 'কুরিয়ার লাইভ স্ট্যাটাস অনুযায়ী পার্সেলটি বাতিল করা হয়েছে।',
                        'location'      => $order->city ?? 'Courier Hub',
                        'tracking_date' => now(),
                    ]);

                    return back()->with('success', 'কুরিয়ার স্ট্যাটাস Cancelled হওয়ায় আপনার সাইটে অর্ডারটি "Cancelled" করা হয়েছে।');
                }

                if ($courierStatus === 'delivered') {
                    $order->order_status = 'Delivered';
                    $order->save();

                    OrderTracking::create([
                        'order_id'      => $order->id,
                        'status'        => 'Delivered',
                        'description'   => 'অভিনন্দন! আপনার পার্সেলটি সফলভাবে ডেলিভারি সম্পন্ন হয়েছে।',
                        'location'      => $order->city ?? 'Courier Hub',
                        'tracking_date' => now(),
                    ]);

                    return back()->with('success', 'কুরিয়ার লাইভ স্ট্যাটাস সফলভাবে সিঙ্ক হয়েছে। (Status: Delivered)');
                }

                // অন্যান্য পেন্ডিং, ইন-রিভিউ এবং হোল্ড স্ট্যাটাসের জন্য
                $order->order_status = 'Processing';
                $order->save();

                $statusDescriptions = [
                    'pending'                            => 'আপনার পার্সেলটি বর্তমানে স্টেডফাস্ট কুরিয়ারে বুকিং অবস্থায় আছে।',
                    'in_review'                          => 'আপনার অর্ডারটি কুরিয়ার প্যানেলে রিভিউ বা যাচাই করা হচ্ছে।',
                    'hold'                               => 'কোনো বিশেষ কারণে আপনার পার্সেলটি কুরিয়ার হাবে হোল্ড (স্থগিত) রাখা হয়েছে।',
                    'delivered_approval_pending'         => 'পার্সেল ডেলিভারি সম্পন্ন হয়েছে, চূড়ান্ত অনুমোদনের কাজ চলছে।',
                    'partial_delivered_approval_pending' => 'পার্সেলটি আংশিক ডেলিভারি করা হয়েছে এবং অনুমোদনের অপেক্ষায় আছে।',
                ];

                $finalDescription = $statusDescriptions[$courierStatus] ?? 'কুরিয়ার লাইভ স্ট্যাটাস আপডেট করা হয়েছে: ' . ucfirst($courierStatus);

                OrderTracking::create([
                    'order_id'      => $order->id,
                    'status'        => 'Processing',
                    'description'   => $finalDescription, 
                    'location'      => $order->city ?? 'Courier Hub',
                    'tracking_date' => now(),
                ]);

                return back()->with('success', 'কুরিয়ার লাইভ স্ট্যাটাস সফলভাবে সিঙ্ক হয়েছে। (Status: ' . $courierStatus . ')'); 
            }

            $order->order_status = 'Cancelled';
            $order->save();
            return back()->with('warning', 'কুরিয়ারে কোনো ডাটা রেসপন্স না থাকায় লোকাল অর্ডারটি "Cancelled" করা হয়েছে।');

        } catch (\Exception $e) {
            $order->order_status = 'Cancelled';
            $order->save();
            return back()->with('success', 'কুরিয়ার থেকে অর্ডারটি মুছে ফেলায় আপনার সাইটে এটি "Cancelled" করা হয়েছে।');
        }
    }
}