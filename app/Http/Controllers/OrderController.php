<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display list of all orders with filtering and search
     */
    public function manageOrder(Request $request)
    {
        $query = Orders::with('user');
        
        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%$search%")
                  ->orWhere('customer_name', 'like', "%$search%")
                  ->orWhere('customer_email', 'like', "%$search%")
                  ->orWhere('customer_phone', 'like', "%$search%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $orders = $query->latest('created_at')->get();

        return view('admin.manage-orders.manage-orders', [
            'orders' => $orders,
        ]);
    }

    /**
     * Show order details
     */
    public function viewOrder($id)
    {
        $order = Orders::with('user', 'items')->findOrFail($id);
        
        return view('admin.manage-orders.view-order', [
            'order' => $order,
        ]);
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Orders::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    /**
     * Add notes to order
     */
    public function addNotes(Request $request, $id)
    {
        $request->validate([
            'notes' => 'required|string|max:500'
        ]);

        $order = Orders::findOrFail($id);
        $order->notes = $request->notes;
        $order->save();

        return redirect()->back()->with('success', 'Notes added successfully!');
    }
}
