<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function storeCustomerReview(Request $request) {
          $request->validate([
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|between:1,5',
            'review_text' => 'required|string|min:5|max:1000'
          ]);


          $user = Auth::user();


          $isValidedOrder = Order::where('id', $request->order_id)
                                  ->where('user_id', $user->id)
                                  ->where('order_status', 'Delivered')
                                  ->whereHas('orderItems', function ($query) use($request){
                                    $query->where('product_id', $request->product_id);
                                  })
                                  ->exists();
          
          if(!$isValidedOrder) {
            return back()->with('error', 'আপনি ইতিমধ্যে এই প্রোডাক্টটির জন্য আপনার রিভিউ সাবমিট করেছেন।');
          };
          

          $alreadyReviewed = Review::where('user_id', $user->id)
                                    ->where('order_id', $request->order_id)
                                    ->where('product_id', $request->product_id)
                                    ->exists();
          
          if($alreadyReviewed) {
            return back()->with('error', 'আপনি ইতিমধ্যে এই অর্ডারের জন্য আপনার রিভিউ সাবমিট করেছেন।');
          }

          try {
            Review::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'order_id' => $request->order_id,
                'reviewer_name' => $user->name,
                'review_text'  => $request->review_text,
                'rating' => $request->rating,
                'is_active' => 1,
             ]);

             return back()->with('success', 'আপনার মূল্যবান রিভিউটির জন্য ধন্যবাদ!');
          } catch(error) {
              return back()->with('error', 'রিভিউ সেভ করতে সমস্যা হয়েছে, আবার চেষ্টা করুন।');
          }


    }
}
