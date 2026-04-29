<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart page
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your cart.');
        }

        $cartItems = Cart::with(['product.images', 'product.category', 'product.subcategory'])
        ->where('user_id', Auth::id())
        ->get();

        $subtotal = $cartItems->sum('total_price');
        $tax = $subtotal * 0.10; // 10% tax
        $total = $subtotal + $tax;

        return view('cart', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    /**
     * Add to cart (AJAX request)
     */
    public function addToCartAjax(Request $request, $productId)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add items to cart.',
                'redirect' => route('login')
            ], 401);
        }

        try {
            $product = Product::findOrFail($productId);
               $quantity = $request->input('quantity', 1);

            //$quantity = $request->quantity ?? 1;

            // Check if product already exists in cart
            $existingCartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();

            if ($existingCartItem) {
                // Update quantity
                $existingCartItem->quantity += $quantity;
                $existingCartItem->total_price = $existingCartItem->quantity * $existingCartItem->price;
                $existingCartItem->save();
                $message = 'Product quantity updated in cart.';
            } else {
                // Add new item to cart
                $price = $product->discount_price ?? $product->regular_price;

                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total_price' => $quantity * $price
                ]);
                $message = 'Product added to cart successfully.';
            }

            // Get updated cart count
            $cartCount = $this->getCartCount();

            return response()->json([
                'success' => true,
                'message' => $message,
                'cart_count' => $cartCount,
                'redirect' => route('cart')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding product to cart: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add to cart (non-AJAX request)
     */
    public function addToCart(Request $request, $productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to add items to cart.');
        }

        try {
            $product = Product::findOrFail($productId);
               $quantity = $request->input('quantity', 1);
            //$quantity = $request->quantity ?? 1;

            // Check if product already exists in cart
            $existingCartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();

            if ($existingCartItem) {
                // Update quantity
                $existingCartItem->quantity += $quantity;
                $existingCartItem->total_price = $existingCartItem->quantity * $existingCartItem->price;
                $existingCartItem->save();
                $message = 'Product quantity updated in cart.';
            } else {
                // Add new item to cart
                $price = $product->discount_price ?? $product->regular_price;

                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total_price' => $quantity * $price
                ]);
                $message = 'Product added to cart successfully.';
            }

            return redirect()->route('cart')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding product to cart.');
        }
    }

    /**
     * Update cart quantity
     */
public function updateCart(Request $request, $cartId)
{
    if (!Auth::check()) {
        return response()->json([
            'success' => false,
            'message' => 'Please login to update cart.'
        ], 401);
    }

    try {
        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($cartId);

        if ($request->quantity <= 0) {
            $cartItem->delete();
            
            // Recalculate totals
            $cartItems = Cart::where('user_id', Auth::id())->get();
            $subtotal = $cartItems->sum('total_price');
            $total = $subtotal;

            return response()->json([
                'success' => true,
                'subtotal' => number_format($subtotal, 2),
                'total' => number_format($total, 2),
                'item_total' => '0.00',
                'cart_count' => $this->getCartCount()
            ]);
        } else {
            $cartItem->quantity = $request->quantity;
            $cartItem->total_price = $cartItem->quantity * $cartItem->price;
            $cartItem->save();

            // Recalculate totals
            $cartItems = Cart::where('user_id', Auth::id())->get();
            $subtotal = $cartItems->sum('total_price');
            $total = $subtotal;

            return response()->json([
                'success' => true,
                'subtotal' => number_format($subtotal, 2),
                'total' => number_format($total, 2),
                'item_total' => number_format($cartItem->total_price, 2),
                'cart_count' => $this->getCartCount()
            ]);
        }
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error updating cart: ' . $e->getMessage()
        ], 500);
    }
}

    /**
     * Remove item from cart
     */
    public function removeFromCart($cartId)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to remove items from cart.'
            ], 401);
        }

        try {
            $cartItem = Cart::where('user_id', Auth::id())->findOrFail($cartId);
            $cartItem->delete();

            // Recalculate totals
            $cartItems = Cart::where('user_id', Auth::id())->get();
            $subtotal = $cartItems->sum('total_price');
            $tax = $subtotal * 0.10;
            $total = $subtotal + $tax;

            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart.',
                'subtotal' => number_format($subtotal, 2),
                'tax' => number_format($tax, 2),
                'total' => number_format($total, 2),
                'cart_count' => $this->getCartCount()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error removing item from cart.'
            ], 500);
        }
    }

    /**
     * Get cart count (for AJAX)
     */
public function getCartCount()
{
    if (!Auth::check()) {
        return 0;
    }

    return Cart::where('user_id', Auth::id())->sum('quantity');
}

    /**
     * Clear cart
     */
    public function clearCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to clear cart.');
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('cart')->with('success', 'Cart cleared successfully.');
    }

    /**
     * Get cart count (internal method)
     */
    // App\Http\Controllers\CartController.php
public function checkout()
{
    $cartItems = Cart::with('product')
        ->where('user_id', Auth::id())
        ->get();
      $subtotal = $cartItems->sum('total_price');
    
    // Total calculate (ekhane subtotal same, jodi tax/discount thake tahole add korben)
    $total = $subtotal;
    
    return view('checkout', compact('cartItems', 'subtotal', 'total'));
}
    private function getCartCountInternal()
    {
        if (!Auth::check()) {
            return 0;
        }

        return Cart::where('user_id', Auth::id())->sum('quantity');
    }
}
