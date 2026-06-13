<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getCartItems()
    {
        if (Auth::check()) {
            return Cart::with(['product.images', 'product.category', 'product.subcategory'])
                ->where('user_id', Auth::id())
                ->get();
        }

        $sessionCart = session()->get('cart', []);
        $cartItems = collect();

        foreach ($sessionCart as $productId => $details) {
            $product = Product::with(['images', 'category', 'subcategory'])->find($productId);
            if ($product) {
                $cart = new Cart();
                $cart->id = $productId;
                $cart->product_id = $productId;
                $cart->quantity = $details['quantity'];
                $cart->price = $details['price'];
                $cart->total_price = $details['quantity'] * $details['price'];
                $cart->setRelation('product', $product);
                $cartItems->push($cart);
            }
        }

        return $cartItems;
    }

    public function index()
    {
        $cartItems = $this->getCartItems();
        $subtotal = $cartItems->sum('total_price');
        $tax = $subtotal * 0.10;
        $total = $subtotal + $tax;

        return view('cart', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    public function addToCartAjax(Request $request, $productId)
    {
        try {
            $product = Product::findOrFail($productId);
            $quantity = max(1, (int) $request->input('quantity', 1));

            if ($product->stock_quantity < $quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Requested quantity is not available in stock.'
                ], 422);
            }

            $price = $product->discount_price ?? $product->regular_price;
            $message = '';

            if (Auth::check()) {
                $existingCartItem = Cart::where('user_id', Auth::id())->where('product_id', $productId)->first();

                if ($existingCartItem) {
                    $existingCartItem->quantity += $quantity;
                    if ($product->stock_quantity < $existingCartItem->quantity) {
                        return response()->json(['success' => false, 'message' => 'Requested quantity exceeds stock.'], 422);
                    }
                    $existingCartItem->total_price = $existingCartItem->quantity * $price;
                    $existingCartItem->save();
                    $message = 'Product quantity updated in cart.';
                } else {
                    Cart::create([
                        'user_id'     => Auth::id(),
                        'product_id'  => $productId,
                        'quantity'    => $quantity,
                        'price'       => $price,
                        'total_price' => $quantity * $price,
                    ]);
                    $message = 'Product added to cart successfully.';
                }
            } else {
                $cart = session()->get('cart', []);
                if (isset($cart[$productId])) {
                    $newQuantity = $cart[$productId]['quantity'] + $quantity;
                    if ($product->stock_quantity < $newQuantity) {
                        return response()->json(['success' => false, 'message' => 'Requested quantity exceeds stock.'], 422);
                    }
                    $cart[$productId]['quantity'] = $newQuantity;
                    $message = 'Product quantity updated in cart.';
                } else {
                    $cart[$productId] = ['quantity' => $quantity, 'price' => $price];
                    $message = 'Product added to cart successfully.';
                }
                session()->put('cart', $cart);
            }

            // 🎯 জাভাস্ক্রিপ্ট ক্লায়েন্টের নোটিফিকেশন সিস্টেমের সাথে রেসপন্স সিঙ্ক করা হলো
            return response()->json([
                'success'    => true,
                'message'    => $message,
                'cart_count' => $this->getCartCount()
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function addToCart(Request $request, $productId)
    {
        try {
            $product = Product::findOrFail($productId);
            $quantity = max(1, (int) $request->input('quantity', 1));

            if ($product->stock_quantity < $quantity) {
                return redirect()->back()->with('error', 'Requested quantity is not available in stock.');
            }

            $price = $product->discount_price ?? $product->regular_price;

            if (Auth::check()) {
                $existingCartItem = Cart::where('user_id', Auth::id())->where('product_id', $productId)->first();
                if ($existingCartItem) {
                    $existingCartItem->quantity += $quantity;
                    if ($product->stock_quantity < $existingCartItem->quantity) {
                        return redirect()->back()->with('error', 'Requested quantity exceeds available stock.');
                    }
                    $existingCartItem->total_price = $existingCartItem->quantity * $price;
                    $existingCartItem->save();
                } else {
                    Cart::create([
                        'user_id'     => Auth::id(),
                        'product_id'  => $productId,
                        'quantity'    => $quantity,
                        'price'       => $price,
                        'total_price' => $quantity * $price,
                    ]);
                }
            } else {
                $cart = session()->get('cart', []);
                if (isset($cart[$productId])) {
                    $newQuantity = $cart[$productId]['quantity'] + $quantity;
                    if ($product->stock_quantity < $newQuantity) {
                        return redirect()->back()->with('error', 'Requested quantity exceeds available stock.');
                    }
                    $cart[$productId]['quantity'] = $newQuantity;
                } else {
                    $cart[$productId] = ['quantity' => $quantity, 'price' => $price];
                }
                session()->put('cart', $cart);
            }

            return redirect()->route('cart')->with('success', 'Product added to cart.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding product to cart.');
        }
    }

    public function updateCart(Request $request, $cartId)
    {
        try {
            $itemTotalPrice = 0;

            if (Auth::check()) {
                $cartItem = Cart::where('user_id', Auth::id())->with('product')->findOrFail($cartId);
                if ($request->quantity <= 0) {
                    $cartItem->delete();
                } else {
                    if ($cartItem->product && $request->quantity > $cartItem->product->stock_quantity) {
                        return response()->json(['success' => false, 'message' => 'Exceeds available stock.'], 422);
                    }
                    $cartItem->quantity    = $request->quantity;
                    $cartItem->total_price = $cartItem->quantity * $cartItem->price;
                    $cartItem->save();
                    $itemTotalPrice = $cartItem->total_price;
                }
            } else {
                $cart = session()->get('cart', []);
                if (isset($cart[$cartId])) {
                    if ($request->quantity <= 0) {
                        unset($cart[$cartId]);
                    } else {
                        $product = Product::find($cartId);
                        if ($product && $request->quantity > $product->stock_quantity) {
                            return response()->json(['success' => false, 'message' => 'Exceeds available stock.'], 422);
                        }
                        $cart[$cartId]['quantity'] = $request->quantity;
                        $itemTotalPrice = $request->quantity * $cart[$cartId]['price'];
                    }
                    session()->put('cart', $cart);
                }
            }

            $cartItems = $this->getCartItems();
            $subtotal  = $cartItems->sum('total_price');

            return response()->json([
                'success'    => true,
                'subtotal'   => number_format($subtotal, 2),
                'total'      => number_format($subtotal, 2),
                'item_total' => number_format($itemTotalPrice, 2),
                'cart_count' => $this->getCartCount(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating cart.'], 500);
        }
    }

    public function removeFromCart($cartId)
    {
        try {
            if (Auth::check()) {
                Cart::where('user_id', Auth::id())->where('id', $cartId)->delete();
            } else {
                $cart = session()->get('cart', []);
                if (isset($cart[$cartId])) {
                    unset($cart[$cartId]);
                    session()->put('cart', $cart);
                }
            }

            $cartItems = $this->getCartItems();
            $subtotal  = $cartItems->sum('total_price');
            $tax       = $subtotal * 0.10;
            $total     = $subtotal + $tax;

            return response()->json([
                'success'    => true,
                'message'    => 'Item removed from cart.',
                'subtotal'   => number_format($subtotal, 2),
                'tax'        => number_format($tax, 2),
                'total'      => number_format($total, 2),
                'cart_count' => $this->getCartCount(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error removing item.'], 500);
        }
    }

    public function getCartCount()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->sum('quantity');
        }

        $cart = session()->get('cart', []);
        return array_sum(array_column($cart, 'quantity'));
    }

    public function clearCart()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        return redirect()->route('cart')->with('success', 'Cart cleared successfully.');
    }

    public function checkout()
    {
        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty. Add items before checkout.');
        }

        $subtotal = $cartItems->sum('total_price');
        $total    = $subtotal;

        return view('checkout', compact('cartItems', 'subtotal', 'total'));
    }
}