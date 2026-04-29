<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display wishlist page
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your wishlist.');
        }

        $wishlistItems = Wishlist::with('product.category', 'product.subcategory')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('wishlist', compact('wishlistItems'));
    }

    /**
     * Add to wishlist (AJAX)
     */
    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add items to wishlist.',
                'redirect' => route('login')
            ], 401);
        }

        try {
            $productId = $request->product_id;
            
            // Check if already in wishlist
            $exists = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product already in wishlist.'
                ]);
            }

            // Add to wishlist
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $productId
            ]);

            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

            return response()->json([
                'success' => true,
                'message' => 'Product added to wishlist!',
                'wishlist_count' => $wishlistCount
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding to wishlist: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove from wishlist (AJAX)
     */
   /**
 * Remove from wishlist (AJAX)
 */
public function remove(Request $request)
{
    if (!Auth::check()) {
        return response()->json([
            'success' => false,
            'message' => 'Please login to remove items from wishlist.'
        ], 401);
    }

    try {
        $productId = $request->product_id;
        
        $deleted = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        if ($deleted) {
            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

            return response()->json([
                'success' => true,
                'message' => 'Product removed from wishlist.',
                'wishlist_count' => $wishlistCount
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product not found in wishlist.'
        ]);

    } catch (\Exception $e) {
        //\Log::error('Wishlist remove error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Error removing from wishlist: ' . $e->getMessage()
        ], 500);
    }
}

    /**
     * Toggle wishlist (Add/Remove)
     */
    public function toggle(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to manage wishlist.',
                'redirect' => route('login')
            ], 401);
        }

        try {
            $productId = $request->product_id;
            
            $wishlistItem = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();

            if ($wishlistItem) {
                // Remove from wishlist
                $wishlistItem->delete();
                $message = 'Removed from wishlist';
                $inWishlist = false;
            } else {
                // Add to wishlist
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId
                ]);
                $message = 'Added to wishlist';
                $inWishlist = true;
            }

            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

            return response()->json([
                'success' => true,
                'message' => $message,
                'in_wishlist' => $inWishlist,
                'wishlist_count' => $wishlistCount
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get wishlist count
     */
    public function getCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $count = Wishlist::where('user_id', Auth::id())->count();
        
        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }

    /**
     * Get wishlist product IDs
     */
    public function getProductIds()
    {
        if (!Auth::check()) {
            return response()->json(['product_ids' => []]);
        }

        $productIds = Wishlist::where('user_id', Auth::id())
            ->pluck('product_id')
            ->toArray();

        return response()->json([
            'success' => true,
            'product_ids' => $productIds
        ]);
    }
}