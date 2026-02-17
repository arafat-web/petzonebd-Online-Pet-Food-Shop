<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getContent();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.list')->with('error', 'Your cart is empty');
        }

        return view('client.checkout.index', [
            'cartItems' => $cartItems,
            'total' => Cart::getTotal(),
            'subtotal' => Cart::getSubTotal(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:100',
            'shipping_postal_code' => 'nullable|string|max:20',
            'payment_method' => 'required|in:cod,card,bkash,nagad',
            'notes' => 'nullable|string|max:500',
        ]);

        $cartItems = Cart::getContent();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.list')->with('error', 'Your cart is empty');
        }

        // Create order
        $order = new Order();
        $order->order_number = 'ORD-' . date('Ymd') . '-' . strtoupper(uniqid());
        $order->user_id = auth()->id();
        $order->customer_name = $validated['customer_name'];
        $order->customer_email = $validated['customer_email'];
        $order->customer_phone = $validated['customer_phone'];
        $order->shipping_address = $validated['shipping_address'];
        $order->shipping_city = $validated['shipping_city'];
        $order->shipping_postal_code = $validated['shipping_postal_code'] ?? null;
        $order->subtotal = Cart::getSubTotal();
        $order->shipping_cost = 0; // Free shipping for now
        $order->tax = 0;
        $order->total = Cart::getTotal();
        $order->payment_method = $validated['payment_method'];
        $order->status = $validated['payment_method'] === 'cod' ? 'pending' : 'processing';
        $order->notes = $validated['notes'] ?? null;
        $order->save();

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'product_name' => $item->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'total' => $item->price * $item->quantity,
            ]);
        }

        // Clear cart
        Cart::clear();

        return redirect()->route('order.confirmation', $order->id)->with('success', 'Order placed successfully!');
    }

    public function confirmation($id)
    {
        $order = Order::with('items')->findOrFail($id);
        
        if ($order->user_id && $order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('client.checkout.confirmation', ['order' => $order]);
    }
}
