<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderTracking;
use App\Models\Product;
use App\Models\Setting;
use App\Models\DeliverySetting; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderInvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http; // 👈 স্টেডফাস্ট এপিআই কল করার জন্য নতুন যুক্ত করা হয়েছে
use Throwable;

class OrderController extends Controller
{
    /**
     * 🌐 লাইভ ডেলিভারি রেট ফ্রন্টএন্ডে সাপ্লাই করার এপিআই মেথড
     */
    public function getCharges()
    {
        $settings = DeliverySetting::first();

        return response()->json([
            'inside_dhaka'  => $settings ? $settings->inside_dhaka : 60.00,
            'outside_dhaka' => $settings ? $settings->outside_dhaka : 120.00,
        ]);
    }

    public function placeOrder(Request $request)
    {
        // 💡 শুধুমাত্র নাম, ফোন, পেমেন্ট মেথড এবং এরিয়া ভ্যালিডেশন রাখা হয়েছে (বাকিগুলো বাদ)
        $request->validate([
            'name'           => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string|max:1000', // এড্রেস নেওয়া বাধ্যতামুলক করা হলো
            'payment_method' => 'required|string|in:Cash On Delivery',
            'order_notes'    => 'nullable|string',
            'delivery_area'  => 'required|string|in:inside,outside', 
        ]);

        $isGuest = !Auth::check();
        $guestToken = $isGuest ? Str::random(64) : null;

        try {
            // ১. ডাটাবেস ট্রানজেকশন শুরু
            $order = DB::transaction(function () use ($request, $isGuest, $guestToken) {

                $cartItems = collect();
                if ($isGuest) {
                    $sessionCart = session()->get('cart', []);

                    if (empty($sessionCart)) {
                        throw new \RuntimeException('Your cart is empty. Please add items before placing the order.');
                    }

                    foreach ($sessionCart as $productId => $details) {
                        $product = Product::find($productId);
                        if (!$product) {
                            throw new \RuntimeException('One of the cart items is no longer available.');
                        }
                        if ($product->stock_quantity < $details['quantity']) {
                            throw new \RuntimeException("Product '{$product->name}' is out of stock.");
                        }
                        $cartItems->push((object) [
                            'product_id'  => $productId,
                            'product'     => $product,
                            'quantity'    => $details['quantity'],
                            'price'       => $details['price'],
                            'total_price' => $details['quantity'] * $details['price'],
                        ]);
                    }
                } else {
                    $cartItems = Auth::user()->carts()
                        ->with('product')
                        ->lockForUpdate()
                        ->get();

                    if ($cartItems->isEmpty()) {
                        throw new \RuntimeException('Your cart is empty. Please add items before placing the order.');
                    }

                    foreach ($cartItems as $item) {
                        if (!$item->product) {
                            throw new \RuntimeException('One of the cart items is no longer available.');
                        }
                        if ($item->quantity < 1) {
                            throw new \RuntimeException("Invalid quantity for '{$item->product->name}'.");
                        }
                        if ($item->product->stock_quantity < $item->quantity) {
                            throw new \RuntimeException("Product '{$item->product->name}' is out of stock.");
                        }
                    }
                }

                // 🚚 ব্যাকএন্ড ডাইনামিক ডেলিভারি চার্জ মেকানিজম
                $subtotal = $cartItems->sum('total_price');
                
                $deliverySetting = DeliverySetting::first();
                if ($request->delivery_area === 'inside') {
                    $shippingCost = $deliverySetting ? $deliverySetting->inside_dhaka : 60.00;
                } else {
                    $shippingCost = $deliverySetting ? $deliverySetting->outside_dhaka : 120.00;
                }

                $tax         = 0;
                $totalAmount = $subtotal + $shippingCost + $tax; 
                $orderNumber      = '#' . strtoupper(uniqid());
                $expectedDelivery = now()->addDays(7)->toDateString();

                // 💡 ডাটাবেজ কলামের সাথে ফর্ম ইনপুট ম্যাচিং করে ইনসার্ট
                $order = Order::create([
                    'user_id'                => $isGuest ? null : Auth::id(),
                    'guest_token'            => $guestToken,
                    'guest_name'             => $isGuest ? $request->name : null,
                    'order_number'           => $orderNumber,
                    'subtotal'               => $subtotal,
                    'shipping_cost'          => $shippingCost, 
                    'tax'                    => $tax,
                    'total_amount'           => $totalAmount,  
                    'payment_method'         => $request->payment_method,
                    'payment_status'         => 'Pending',
                    'order_status'           => 'Pending',
                    'order_notes'            => $request->order_notes,
                    'address'                => $request->address, // 💡 মাইগ্রেশন অনুযায়ী মূল এড্রেস কলাম
                    'phone'                  => $request->phone,
                    'expected_delivery_date' => $expectedDelivery,
                ]);

                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'order_id'      => $order->id,
                        'product_id'    => $item->product_id,
                        'product_name'  => $item->product->name,
                        'product_image' => $item->product->thumbnail,
                        'quantity'      => $item->quantity,
                        'price'         => $item->price,
                        'total_price'   => $item->total_price,
                    ]);

                    $item->product->decrement('stock_quantity', $item->quantity);
                }

                OrderTracking::create([
                    'order_id'      => $order->id,
                    'status'        => 'Receiving orders',
                    'description'   => 'Your order has been received and is being processed.',
                    'location'      => ($request->delivery_area === 'inside') ? 'Dhaka' : 'Outside Dhaka',
                    'tracking_date' => now(),
                ]);

                return $order;
            });

            // ২. রিলেশনশিপ নিরাপদে লোড করা
            try {
                $order->load(['user', 'orderItems.product']);
            } catch (\Throwable $e) {
                $order->load(['user', 'orderltems.product']);
            }

            // ৩. ইউজারের প্রোফাইল আপডেট ( his ফোন এবং এড্রেস আপডেট হবে)
            if (!$isGuest) {
                try {
                    Auth::user()->update([
                        'phone'   => $request->phone,
                        'address' => $request->address,
                    ]);
                } catch (\Throwable $profileError) {
                    Log::error('User profile update failed: ' . $profileError->getMessage());
                }
            }

            // ৪. মেইল পাঠানো (ইমেইল ফিল্ড থাকলে পাঠাবে, না থাকলে স্কিপ করবে)
            $userEmail = !empty(Auth::user()->email ?? '') ? (Auth::user()->email) : ($request->email ?? null);
            if ($userEmail) {
                try {
                    $siteSettings = Setting::first() ?? new Setting();
                    Mail::to($userEmail)->send(new OrderInvoiceMail($order, $siteSettings));
                } catch (\Throwable $mailException) {
                    Log::warning('Order invoice email failed to send: ' . $mailException->getMessage());
                }
            }

            // ৫. কার্ট ক্লিয়ার করা
            if ($isGuest) {
                session()->forget('cart');
                session()->put('guest_order_token', $guestToken);
            } else {
                Auth::user()->carts()->delete();
            }

            return redirect()->route('order.success', ['order' => $order->id])
                ->with('success', 'Order placed successfully!');

        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }

    public function orderSuccess(Order $order)
    {
        try {
            $order->load(['user', 'orderItems.product']);
        } catch (\Throwable $e) {
            $order->load(['user', 'orderltems.product']);
        }

        if (Auth::check()) {
            if ($order->user_id !== Auth::id()) {
                abort(403);
            }
        } else {
            $guestToken = session()->get('guest_order_token');
            if (!$guestToken || $order->guest_token !== $guestToken) {
                abort(403);
            }
        }

        $siteSettings = Setting::first();
        return view('order-success', compact('order', 'siteSettings'));
    }

    public function userOrders()
    {
        try {
            $orders = Order::where('user_id', Auth::id())->with('orderItems')->latest()->paginate(10);
        } catch (\Throwable $e) {
            $orders = Order::where('user_id', Auth::id())->with('orderltems')->latest()->paginate(10);
        }

        return view('orders', compact('orders'));
    }

    /**
          * 🚚 [NEW METHOD] অ্যাডমিন প্যানেল থেকে অর্ডারটি স্টেডফাস্ট কুরিয়ারে পুশ করার জন্য
     */
    public function sendToSteadfast($id)
    {
        $order = Order::findOrFail($id);
        $phone = str_replace([' ', '-', '+88'], '', $order->phone);

       
        $customerName = $order->guest_name ?? ($order->user ? $order->user->name : 'Customer');

       
        try {
            $response = Http::withHeaders([
                'Api-Key'      => env('STEADFAST_API_KEY'),
                'Secret-Key'   => env('STEADFAST_SECRET_KEY'),
                'Content-Type' => 'application/json',
            ])->post(env('STEADFAST_BASE_URL') . '/create_order', [
                'invoice'           => (string) $order->order_number, 
                'recipient_name'    => substr($customerName, 0, 100), 
                'recipient_phone'   => $phone,                       
                'recipient_address' => $order->address,              
                'cod_amount'        => (float) $order->total_amount,  
                'note'              => $order->order_notes ?? 'Please delivery fast', 
            ]);

            if ($response->successful()) {
                $result = $response->json();

                if (isset($result['status']) && $result['status'] == 200) {
                    
                    
                    $order->update([
                        'order_status'   => 'Processing', 
                        'tracking_code'  => $result['consignment']['tracking_code'] ?? null, // [cite: 66]
                    ]);

                   
                    OrderTracking::create([
                        'order_id'      => $order->id,
                        'status'        => 'Handed over to Courier',
                        'description'   => 'Your order has been dispatched via Steadfast Courier. Tracking Code: ' . ($result['consignment']['tracking_code'] ?? ''),
                        'location'      => 'Dhaka Hub',
                        'tracking_date' => now(),
                    ]);

                    return back()->with('success', 'Order successfully sent to Steadfast Courier!');
                }

                return back()->with('error', 'Courier Error: ' . ($result['message'] ?? 'Unknown error occurred.'));
            }

            return back()->with('error', 'Failed to connect with Steadfast Courier API.');

        } catch (\Exception $e) {
            Log::error('Steadfast API Error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * 🔄 [NEW METHOD] যেকোনো সময় সিঙ্গেল ক্লিকের মাধ্যমে স্টেডফাস্ট থেকে লাইভ স্ট্যাটাস সিঙ্ক করার জন্য
     */
    public function checkSteadfastStatus($id)
    {
        $order = Order::findOrFail($id);

        if (!$order->tracking_code) {
            return back()->with('error', 'This order has not been sent to Steadfast yet.');
        }

        try {
            // ইনভয়েস নম্বর (অথবা ট্র্যাকিং কোড) দিয়ে স্ট্যাটাস চেক করার এন্ডপয়েন্ট [cite: 201]
            $response = Http::withHeaders([
                'Api-Key'    => env('STEADFAST_API_KEY'),
                'Secret-Key' => env('STEADFAST_SECRET_KEY'),
            ])->get(env('STEADFAST_BASE_URL') . '/status_by_invoice/' . $order->order_number); // [cite: 201]

            if ($response->successful()) {
                $result = $response->json();

                if (isset($result['status']) && $result['status'] == 200) {
                    $courierStatus = $result['delivery_status']; // উদাহরণ: delivered, pending, cancelled, hold [cite: 218, 230]

                    // স্টেডফাস্টের লাইভ রেসপন্স অনুযায়ী আপনার সিস্টেমে স্ট্যাটাস কনভার্ট করুন
                    $mappedStatus = 'Processing';
                    if ($courierStatus === 'delivered') {
                        $mappedStatus = 'Delivered';
                    } elseif (in_array($courierStatus, ['cancelled_approval_pending', 'unknown_approval_pending'])) {
                        $mappedStatus = 'Cancelled';
                    }

                    // ডাটাবেজ আপডেট
                    $order->update([
                        'order_status' => $mappedStatus
                    ]);

                    // ট্র্যাকিং লগ আপডেট করা
                    OrderTracking::create([
                        'order_id'      => $order->id,
                        'status'        => 'Courier Update: ' . ucfirst($courierStatus),
                        'description'   => 'Live courier delivery status synced from Steadfast.',
                        'location'      => 'Courier Hub',
                        'tracking_date' => now(),
                    ]);

                    return back()->with('success', 'Order status updated successfully to: ' . $courierStatus);
                }
            }

            return back()->with('error', 'Could not sync status from courier.');

        } catch (\Exception $e) {
            return back()->with('error', 'Status check failed: ' . $e->getMessage());
        }
    }



    public function trackOrderForm() {
        return view('tracking-order');
    }

    public function handleOrderTracking(Request $request) {

        $request->validate([
            'phone' => 'required|string',
            'order_number' => 'required|string',
        ]);



        $order = Order::where('order_number', $request->order_number)
                        ->where('phone', $request->phone)
                        ->with('orderItems')
                        ->first();

        
        if (!$order) {
        return back()->withInput()->with('error', 'দুঃখিত, এই অর্ডার নম্বর বা ফোন নম্বরের কোনো রেকর্ড পাওয়া যায়নি।');
        }


        $trackingLogs = OrderTracking::where('order_id', $order->id)->latest()->get();


        return view('tracking-order', compact('order', 'trackingLogs'));


        
    }


}