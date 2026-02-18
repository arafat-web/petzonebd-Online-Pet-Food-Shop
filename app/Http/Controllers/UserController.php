<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show user dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        
        return view('client.user.dashboard', compact('user', 'orders'));
    }

    /**
     * Show user profile
     */
    public function profile()
    {
        $user = Auth::user();
        return view('client.user.profile', compact('user'));
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Show order details
     */
    public function orderDetails($id)
    {
        $order = Order::findOrFail($id);
        
        // Ensure user can only see their own orders
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('client.user.order-details', compact('order'));
    }

    /**
     * Display list of all users (Admin)
     */
    public function manageUsers(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        // Filter by role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        $users = $query->latest('created_at')->get();

        return view('admin.manage-users.manage-users', [
            'users' => $users,
        ]);
    }

    /**
     * View user details (Admin)
     */
    public function viewUser($id)
    {
        $user = User::findOrFail($id);
        $orders = Order::where('user_id', $id)->latest('created_at')->get();

        return view('admin.manage-users.view-user', [
            'user' => $user,
            'orders' => $orders,
        ]);
    }

    /**
     * Delete user
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deleting yourself
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot delete your own account!');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}
