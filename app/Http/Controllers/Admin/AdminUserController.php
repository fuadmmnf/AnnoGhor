<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::withCount('orders')
            // grouping conditions to ensure search and roles don't conflict
            ->where(function($query) {
                $query->where('role', 'user')
                      ->orWhere('role', 'admin');
            })
            ->when(request('search'), function($query) {
                $query->where(function($searchQuery) {
                    $searchQuery->where('name', 'like', '%' . request('search') . '%')
                                ->orWhere('email', 'like', '%' . request('search') . '%');
                });
            })
            ->latest()
            ->paginate(10);

        return view('admin.all-user', compact('users'));
    }

    // 🌟 [NEW] ইউজারের রোল আপডেট করার ফাংশন
    public function updateRole(Request $request, $id)
    {
        // ১. ভ্যালিডেশন: শুধুমাত্র 'admin' বা 'user' রোল ইনপুট নেওয়া যাবে
        $request->validate([
            'role' => 'required|in:admin,user',
        ]);

        try {
            $user = User::findOrFail($id);

            // ২. সিকিউরিটি চেক: কোনো সুপারঅ্যাডমিনের রোল চেঞ্জ করা যাবে না
            if ($user->role === 'superadmin') {
                return redirect()->back()->with('error', 'সুপারঅ্যাডমিনের রোল পরিবর্তন করা সম্ভব নয়!');
            }

            // ৩. রোল আপডেট এবং সেভ
            $user->role = $request->role;
            $user->save();

            return redirect()->back()->with('success', $user->name . '-এর রোল সফলভাবে আপডেট করা হয়েছে।');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'রোল আপডেট করতে সমস্যা হয়েছে: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // 🌟 [UPDATED] Admin বা Superadmin কাউকেই ডিলিট করা যাবে না
            if (in_array($user->role, ['admin', 'superadmin'])) {
                return redirect()->back()->with('error', 'অ্যাডমিন বা সুপারঅ্যাডমিন ইউজার ডিলিট করা সম্ভব নয়!');
            }

            // Check if user has orders
            if ($user->orders()->count() > 0) {
                return redirect()->back()->with('error', 'Cannot delete user with existing orders!');
            }

            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }
}