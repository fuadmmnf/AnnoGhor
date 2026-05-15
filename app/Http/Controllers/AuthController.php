<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cart; // <--- এটি অবশ্যই অ্যাড করতে হবে
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // === লগইন সফল হওয়ার পর কার্ট মার্জ করা হচ্ছে ===
            $this->mergeCartToDatabase($user);

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // User Registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        // === নতুন রেজিস্ট্রেশন করে অটো লগইন হওয়ার পর কার্ট মার্জ করা হচ্ছে ===
        $this->mergeCartToDatabase($user);

        return redirect()->route('home')->with('success', 'Registration successful!');
    }

    // User Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    /**
     * Session Cart থেকে Database Cart-এ ডাটা ট্রান্সফার করার হেল্পার মেথড
     */
    private function mergeCartToDatabase($user)
    {
        // চেক করছি সেশনে কার্ট নামে কিছু আছে কিনা
        if (session()->has('cart')) {
            $sessionCart = session()->get('cart');

            foreach ($sessionCart as $productId => $details) {
                // চেক করছি এই প্রোডাক্ট আগে থেকেই ইউজারের কার্টে আছে কিনা
                $existingCart = Cart::where('user_id', $user->id)
                                    ->where('product_id', $productId)
                                    ->first();

                if ($existingCart) {
                    // আগে থেকে থাকলে শুধু কোয়ান্টিটি এবং দাম আপডেট হবে
                    $existingCart->quantity += $details['quantity'];
                    $existingCart->total_price = $existingCart->quantity * $existingCart->price;
                    $existingCart->save();
                } else {
                    // নতুন হলে ডাটাবেসে সেভ হবে
                    Cart::create([
                        'user_id' => $user->id,
                        'product_id' => $productId,
                        'quantity' => $details['quantity'],
                        'price' => $details['price'],
                        'total_price' => $details['quantity'] * $details['price']
                    ]);
                }
            }

            // ডাটাবেসে সেভ করার পর সেশন থেকে কার্ট মুছে ফেলা হচ্ছে
            session()->forget('cart');
        }
    }
}