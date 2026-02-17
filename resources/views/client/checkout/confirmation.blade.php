@extends('client.master')

@section('title')
    Order Confirmation
@endsection

@section('content')
    <!-- ══════════ BREADCRUMB ══════════ -->
    <div class="navigation py-3 py-md-4">
        <div class="container-xl">
            <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order Confirmed</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- ══════════ SUCCESS SECTION ══════════ -->
    <div class="container-xl mb-5 mt-5">
        <div style="text-align: center; max-width: 600px; margin: 0 auto;">
            <!-- Success Icon -->
            <div style="width: 100px; height: 100px; background: rgba(74,103,65,0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; border: 3px solid var(--sage);">
                <i class="bi bi-check-circle-fill" style="font-size: 3rem; color: var(--sage);"></i>
            </div>

            <h1 style="font-family: 'Bebas Neue', sans-serif; font-size: 2.5rem; color: var(--ink); margin-bottom: 0.5rem;">
                Order <em style="color: var(--accent); font-style: normal;">Confirmed!</em>
            </h1>
            <p style="color: #666; font-size: 1.1rem; margin-bottom: 2rem;">Thank you for your purchase. Your order has been placed successfully.</p>

            <!-- Order Number -->
            <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); margin-bottom: 2rem; text-align: left;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; padding: 1.5rem 0;">
                    <div>
                        <p style="color: #999; font-size: 0.85rem; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 1px;">Order Number</p>
                        <p style="color: var(--ink); font-weight: 700; font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem; margin: 0;">{{ $order->order_number }}</p>
                    </div>
                    <div>
                        <p style="color: #999; font-size: 0.85rem; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 1px;">Order Status</p>
                        <p style="color: var(--sage); font-weight: 700; font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem; margin: 0; text-transform: capitalize;">{{ $order->status }}</p>
                    </div>
                    <div>
                        <p style="color: #999; font-size: 0.85rem; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 1px;">Order Date</p>
                        <p style="color: var(--ink); font-weight: 600; margin: 0;">{{ $order->created_at->format('M d, Y - H:i') }}</p>
                    </div>
                    <div>
                        <p style="color: #999; font-size: 0.85rem; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 1px;">Payment Method</p>
                        <p style="color: var(--ink); font-weight: 600; margin: 0; text-transform: uppercase;">{{ $order->payment_method ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Customer Details -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); text-align: left;">
                        <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.1rem; color: var(--ink); margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--accent);">
                            Customer <em style="color: var(--accent); font-style: normal;">Details</em>
                        </h3>
                        <p style="color: #666; font-size: 0.9rem; margin-bottom: 0.5rem;">
                            <strong style="color: var(--ink);">Name:</strong><br> {{ $order->customer_name }}
                        </p>
                        <p style="color: #666; font-size: 0.9rem; margin-bottom: 0.5rem;">
                            <strong style="color: var(--ink);">Email:</strong><br> {{ $order->customer_email }}
                        </p>
                        <p style="color: #666; font-size: 0.9rem;">
                            <strong style="color: var(--ink);">Phone:</strong><br> {{ $order->customer_phone }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); text-align: left;">
                        <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.1rem; color: var(--ink); margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--accent);">
                            Shipping <em style="color: var(--accent); font-style: normal;">Address</em>
                        </h3>
                        <p style="color: #666; font-size: 0.9rem; line-height: 1.6; margin: 0;">
                            {{ $order->shipping_address }}<br>
                            {{ $order->shipping_city }} 
                            @if($order->shipping_postal_code)
                                {{ $order->shipping_postal_code }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); text-align: left; margin-bottom: 2rem;">
                <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.1rem; color: var(--ink); margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--accent);">
                    Order <em style="color: var(--accent); font-style: normal;">Items</em>
                </h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 1px solid var(--border);">
                            <th style="text-align: left; padding: 0.75rem 0; color: #666; font-weight: 600; font-size: 0.85rem; text-transform: uppercase;">Product</th>
                            <th style="text-align: center; padding: 0.75rem 0; color: #666; font-weight: 600; font-size: 0.85rem; text-transform: uppercase;">Qty</th>
                            <th style="text-align: right; padding: 0.75rem 0; color: #666; font-weight: 600; font-size: 0.85rem; text-transform: uppercase;">Price</th>
                            <th style="text-align: right; padding: 0.75rem 0; color: #666; font-weight: 600; font-size: 0.85rem; text-transform: uppercase;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr style="border-bottom: 1px solid var(--border);">
                                <td style="padding: 1rem 0; color: var(--ink); font-weight: 500;">{{ $item->product_name }}</td>
                                <td style="padding: 1rem 0; color: var(--ink); text-align: center;">{{ $item->quantity }}</td>
                                <td style="padding: 1rem 0; color: #666; text-align: right;">৳{{ number_format($item->price, 2) }}</td>
                                <td style="padding: 1rem 0; color: var(--ink); font-weight: 600; text-align: right;">৳{{ number_format($item->total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pricing Summary -->
            <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); text-align: left; margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--border);">
                    <span style="color: #666;">Subtotal</span>
                    <span style="color: var(--ink); font-weight: 600;">৳{{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--border);">
                    <span style="color: #666;">Shipping</span>
                    <span style="color: var(--sage); font-weight: 600;">Free</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: var(--ink); font-weight: 700; font-size: 1.1rem;">Total</span>
                    <span style="color: var(--accent); font-weight: 700; font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem;">৳{{ number_format($order->total, 2) }}</span>
                </div>
            </div>

            <!-- Next Steps -->
            <div style="background: rgba(232,82,26,0.08); border: 1px solid rgba(232,82,26,0.2); border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem; text-align: left;">
                <h4 style="color: var(--ink); margin-bottom: 1rem; font-family: 'Bebas Neue', sans-serif;">What's Next?</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="color: #666; margin-bottom: 0.5rem;">✓ You'll receive an order confirmation email shortly</li>
                    <li style="color: #666; margin-bottom: 0.5rem;">✓ Our team will process your order and notify you</li>
                    <li style="color: #666;">✓ Your order will be delivered within 2-3 business days</li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <a href="{{ route('products', ['category' => 'cat-food']) }}" style="background: transparent; color: var(--ink); border: 2px solid var(--border); padding: 0.9rem 1.5rem; border-radius: 0.5rem; font-weight: 700; text-decoration: none; text-align: center; font-family: 'Bebas Neue', sans-serif; letter-spacing: 1.5px; font-size: 0.9rem; text-transform: uppercase; transition: all 0.2s; display: block;">
                    <i class="bi bi-shop me-2"></i> Continue Shopping
                </a>
                <a href="{{ route('index') }}" style="background: var(--accent); color: white; border: none; padding: 0.9rem 1.5rem; border-radius: 0.5rem; font-weight: 700; text-decoration: none; text-align: center; font-family: 'Bebas Neue', sans-serif; letter-spacing: 1.5px; font-size: 0.9rem; text-transform: uppercase; transition: background 0.2s; display: block;">
                    <i class="bi bi-house me-2"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
@endsection
