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
        $request->validate([
            'name'           => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'email'          => 'required|email',
            'country'        => 'required|string|max:100',
            'city'           => 'nullable|string|max:100',
            'postcode'       => 'nullable|string|max:20',
            'street_address' => 'nullable|string|max:500',
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
                    'country'                => $request->country,
                    'city'                   => $request->city,
                    'postcode'               => $request->postcode,
                    'street_address'         => $request->street_address,
                    'phone'                  => $request->phone,
                    'email'                  => $request->email,
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
                    'location'      => trim(($request->city ?? '') . ', ' . $request->country, ', '),
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

            // ৩. ইউজারের প্রোফাইল আপডেট
            if (!$isGuest) {
                $userProfileData = [
                    'country' => $request->country,
                    'phone'   => $request->phone,
                ];

                if ($request->filled('city')) {
                    $userProfileData['city'] = $request->city;
                }
                if ($request->filled('postcode')) {
                    $userProfileData['postcode'] = $request->postcode;
                }
                if ($request->filled('street_address')) {
                    $userProfileData['street_address'] = $request->street_address;
                }

                try {
                    Auth::user()->update($userProfileData);
                } catch (\Throwable $profileError) {
                    Log::error('User profile update failed: ' . $profileError->getMessage());
                }
            }

            // ৪. মেইল পাঠানো
            try {
                $siteSettings = Setting::first() ?? new Setting();
                Mail::to($order->email)->send(new OrderInvoiceMail($order, $siteSettings));
            } catch (\Throwable $mailException) {
                Log::warning('Order invoice email failed to send.', [
                    'order_id' => $order->id,
                    'email'    => $order->email,
                    'error'    => $mailException->getMessage(),
                ]);
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
}