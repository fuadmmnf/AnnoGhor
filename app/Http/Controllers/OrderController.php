<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderTracking;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderInvoiceMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;
use Throwable;



class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'country' => 'required|string',
            'city' => 'nullable|string',
            'postcode' => 'nullable|string',
            'street_address' => 'nullable|string',
            'payment_method' => 'required|string',
            'order_notes' => 'nullable|string',
        ]);

        try {
            $order = DB::transaction(function () use ($request) {
                $cartItems = Cart::where('user_id', Auth::id())
                    ->with('product')
                    ->lockForUpdate()
                    ->get();

                if ($cartItems->isEmpty()) {
                    throw new \RuntimeException('Your cart is empty!');
                }

                $subtotal = $cartItems->sum('total_price');
                $shippingCost = 0;
                $tax = 0;
                $totalAmount = $subtotal + $shippingCost + $tax;
                $orderNumber = '#' . strtoupper(uniqid());
                $expectedDelivery = now()->addDays(7)->toDateString();

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'order_number' => $orderNumber,
                    'subtotal' => $subtotal,
                    'shipping_cost' => $shippingCost,
                    'tax' => $tax,
                    'total_amount' => $totalAmount,
                    'payment_method' => $request->payment_method,
                    'payment_status' => 'Pending',
                    'order_status' => 'Pending',
                    'order_notes' => $request->order_notes,
                    'country' => $request->country,
                    'city' => $request->city,
                    'postcode' => $request->postcode,
                    'street_address' => $request->street_address,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'expected_delivery_date' => $expectedDelivery,
                ]);

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

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'product_image' => $item->product->thumbnail,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'total_price' => $item->total_price,
                    ]);

                    $item->product->decrement('stock_quantity', $item->quantity);
                }

                OrderTracking::create([
                    'order_id' => $order->id,
                    'status' => 'Receiving orders',
                    'description' => 'Your order has been received and is being processed.',
                    'location' => trim(($request->city ?? '') . ', ' . $request->country, ', '),
                    'tracking_date' => now(),
                ]);

                Cart::where('user_id', Auth::id())->delete();

                Auth::user()?->update([
                    'country' => $request->country,
                    'city' => $request->city,
                    'postcode' => $request->postcode,
                    'street_address' => $request->street_address,
                    'phone' => $request->phone,
                ]);

                return $order;
            });

            $order->load(['user', 'orderItems']);
            $siteSettings = Setting::first();

            // Send mail with PDF
            Mail::to($order->email)
                ->send(new OrderInvoiceMail($order, $siteSettings));

            return redirect()->route('order.success', ['order' => $order->id])
                ->with('success', 'Order placed successfully!');
        } catch (Throwable $e) {
            return back()->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }

    public function orderSuccess(Order $order)
    {
        $order->load(['user', 'orderItems.product']);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('order-success', compact('order'));
    }

    public function userOrders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderItems')
            ->latest()
            ->paginate(10);

        return view('orders', compact('orders'));
    }
}
