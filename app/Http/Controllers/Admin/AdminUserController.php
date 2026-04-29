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
            ->where('role', 'user') // শুধু customer দেখাবে, admin দেখাবে না
            ->when(request('search'), function($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                      ->orWhere('email', 'like', '%' . request('search') . '%');
            })
            ->latest()
            ->paginate(10);

        return view('admin.all-user', compact('users'));
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Admin নিজেকে delete করতে পারবে না
            if ($user->role === 'admin') {
                return redirect()->back()->with('error', 'Cannot delete admin user!');
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