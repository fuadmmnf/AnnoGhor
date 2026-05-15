<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Helper Method: Get cart items for both Auth and Guest users
     */
    private function getCartItems()
    {
        if (Auth::check()) {
            return Cart::with(['product.images', 'product.category', 'product.subcategory'])
                ->where('user_id', Auth::id())
                ->get();
        }

        // Guest User: Fetch from Session
        $sessionCart = session()->get('cart', []);
        $cartItems = collect();

        foreach ($sessionCart as $productId => $details) {
            $product = Product::with(['images', 'category', 'subcategory'])->find($productId);
            if ($product) {
                $cart = new Cart(); // Dummy Cart model for Blade compatibility
                $cart->id = $productId; // Using product_id as cart_id for session manipulation
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

    /**
     * Display the cart page
     */
    public function index()
    {
        $cartItems = $this->getCartItems();
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
                // Auth User Logic
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
                        'user_id' => Auth::id(),
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'price' => $price,
                        'total_price' => $quantity * $price
                    ]);
                    $message = 'Product added to cart successfully.';
                }
            } else {
                // Guest User Logic (Session)
                $cart = session()->get('cart', []);
                if (isset($cart[$productId])) {
                    $newQuantity = $cart[$productId]['quantity'] + $quantity;
                    if ($product->stock_quantity < $newQuantity) {
                        return response()->json(['success' => false, 'message' => 'Requested quantity exceeds stock.'], 422);
                    }
                    $cart[$productId]['quantity'] = $newQuantity;
                    $message = 'Product quantity updated in cart.';
                } else {
                    $cart[$productId] = [
                        'quantity' => $quantity,
                        'price' => $price
                    ];
                    $message = 'Product added to cart successfully.';
                }
                session()->put('cart', $cart);
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'cart_count' => $this->getCartCount(),
                'redirect' => route('cart')
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Add to cart (non-AJAX request)
     */
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
                        'user_id' => Auth::id(),
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'price' => $price,
                        'total_price' => $quantity * $price
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

    /**
     * Update cart quantity
     */
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
                    $cartItem->quantity = $request->quantity;
                    $cartItem->total_price = $cartItem->quantity * $cartItem->price;
                    $cartItem->save();
                    $itemTotalPrice = $cartItem->total_price;
                }
            } else {
                // Session Update (cartId is actually productId for guest)
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
            $subtotal = $cartItems->sum('total_price');

            return response()->json([
                'success' => true,
                'subtotal' => number_format($subtotal, 2),
                'total' => number_format($subtotal, 2), // Add tax here if needed
                'item_total' => number_format($itemTotalPrice, 2),
                'cart_count' => $this->getCartCount()
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating cart.'], 500);
        }
    }

    /**
     * Remove item from cart
     */
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
            return response()->json(['success' => false, 'message' => 'Error removing item.'], 500);
        }
    }

    /**
     * Get cart count
     */
    public function getCartCount()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->sum('quantity');
        }

        $cart = session()->get('cart', []);
        return array_sum(array_column($cart, 'quantity'));
    }

    /**
     * Clear cart
     */
    public function clearCart()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        return redirect()->route('cart')->with('success', 'Cart cleared successfully.');
    }

    /**
     * Checkout
     */
    public function checkout()
    {
        // Checkout requires login. If not logged in, send to login page.
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to proceed to checkout.');
        }

        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty. Add items before checkout.');
        }

        $subtotal = $cartItems->sum('total_price');
        $total = $subtotal; // Add tax/discount calculation here if needed

        return view('checkout', compact('cartItems', 'subtotal', 'total'));
    }
}