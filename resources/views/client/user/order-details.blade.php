@extends('client.master')

@section('title')
    Order #{{ $order->order_number }} - Pet Zone
@endsection

@section('content')
    <!-- ══════════ BREADCRUMB ══════════ -->
    <div style="background: #f9f9f9; border-bottom: 1px solid var(--border); padding: 1rem 0;">
        <div class="container-xl">
            <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="breadcrumb-item"><a href="{{route('index')}}" style="color: var(--accent); text-decoration: none;">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}" style="color: var(--accent); text-decoration: none;">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color: var(--ink);">Order #{{ $order->order_number }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- ══════════ PAGE HEADER ══════════ -->
    <div style="background: var(--light-sage); padding: 2rem 0;" class="mb-5">
        <div class="container-xl">
            <h1 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 6vw, 3rem); color: var(--ink); margin: 0;">
                Order <em style="color: var(--accent); font-style: normal;">#{{ $order->order_number }}</em>
            </h1>
            <p style="color: #666; margin-top: 0.5rem; margin-bottom: 0;">Placed on {{ $order->created_at->format('d M Y - h:i A') }}</p>
        </div>
    </div>

    <!-- ══════════ ORDER DETAILS ══════════ -->
    <div class="container-xl mb-5">
        <div class="row g-4">
            <!-- Order Items -->
            <div class="col-lg-8">
                <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04); margin-bottom: 2rem;">
                    <h3 style="color: var(--ink); margin-bottom: 1.5rem; font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem;">Order Items</h3>

                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="border-bottom: 2px solid var(--border);">
                                    <th style="padding: 1rem; text-align: left; color: var(--ink); font-weight: 600;">Product</th>
                                    <th style="padding: 1rem; text-align: left; color: var(--ink); font-weight: 600;">Price</th>
                                    <th style="padding: 1rem; text-align: left; color: var(--ink); font-weight: 600;">Quantity</th>
                                    <th style="padding: 1rem; text-align: left; color: var(--ink); font-weight: 600;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr style="border-bottom: 1px solid var(--border);">
                                        <td style="padding: 1rem; color: #666;">
                                            <strong>{{ $item->product_name }}</strong>
                                        </td>
                                        <td style="padding: 1rem; color: #666;">
                                            ৳{{ number_format($item->price, 0) }}
                                        </td>
                                        <td style="padding: 1rem; color: #666;">
                                            {{ $item->quantity }}
                                        </td>
                                        <td style="padding: 1rem; color: var(--ink); font-weight: 600;">
                                            ৳{{ number_format($item->total, 0) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 style="color: var(--ink); margin-bottom: 1.5rem; font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem;">Order Summary</h3>

                    <div style="padding: 1rem; background: #f9f9f9; border-radius: 0.5rem; margin-bottom: 1rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span style="color: #666;">Subtotal:</span>
                            <span style="color: var(--ink); font-weight: 600;">৳{{ number_format($order->subtotal, 0) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span style="color: #666;">Shipping:</span>
                            <span style="color: var(--ink); font-weight: 600;">৳{{ number_format($order->total - $order->subtotal, 0) }}</span>
                        </div>
                        <div style="border-top: 1px solid var(--border); padding-top: 0.5rem; margin-top: 0.5rem; display: flex; justify-content: space-between;">
                            <span style="color: var(--ink); font-weight: 700;">Total:</span>
                            <span style="color: var(--accent); font-weight: 700; font-size: 1.2rem;">৳{{ number_format($order->total, 0) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Info Sidebar -->
            <div class="col-lg-4">
                <!-- Status -->
                <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04); margin-bottom: 2rem;">
                    <h4 style="color: var(--ink); margin-bottom: 1rem; font-weight: 600;">Order Status</h4>
                    <div style="padding: 1rem; background: 
                        @if($order->status === 'completed')
                            rgba(74,103,65,0.1)
                        @elseif($order->status === 'pending')
                            rgba(255,193,7,0.1)
                        @else
                            rgba(0,0,0,0.05)
                        @endif
                        ; border-radius: 0.5rem; text-align: center;">
                        @if($order->status === 'completed')
                            <i class="bi bi-check-circle" style="font-size: 2rem; color: var(--sage); display: block; margin-bottom: 0.5rem;"></i>
                            <p style="color: var(--sage); font-weight: 600; margin: 0;">Completed</p>
                        @elseif($order->status === 'pending')
                            <i class="bi bi-hourglass-split" style="font-size: 2rem; color: #ffc107; display: block; margin-bottom: 0.5rem;"></i>
                            <p style="color: #ffc107; font-weight: 600; margin: 0;">Pending</p>
                        @else
                            <i class="bi bi-info-circle" style="font-size: 2rem; color: var(--ink); display: block; margin-bottom: 0.5rem;"></i>
                            <p style="color: var(--ink); font-weight: 600; margin: 0;">{{ ucfirst($order->status) }}</p>
                        @endif
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04); margin-bottom: 2rem;">
                    <h4 style="color: var(--ink); margin-bottom: 1rem; font-weight: 600;">Customer Information</h4>
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                        <div style="width: 50px; height: 50px; background: var(--light-sage); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-person-fill" style="font-size: 1.5rem; color: var(--accent);"></i>
                        </div>
                        <div>
                            <p style="color: var(--ink); font-weight: 600; margin: 0;">{{ $order->customer_name }}</p>
                            <p style="color: #999; font-size: 0.9rem; margin: 0;">{{ $order->customer_email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04); margin-bottom: 2rem;">
                    <h4 style="color: var(--ink); margin-bottom: 1rem; font-weight: 600;">Shipping Address</h4>
                    <div style="padding: 1rem; background: #f9f9f9; border-radius: 0.5rem;">
                        <p style="color: var(--ink); margin: 0; font-weight: 600; margin-bottom: 0.5rem;">{{ $order->customer_name }}</p>
                        <p style="color: #666; margin: 0; font-size: 0.9rem;">{{ $order->shipping_address }}</p>
                        <p style="color: #666; margin: 0; font-size: 0.9rem;">{{ $order->shipping_city }} - {{ $order->shipping_postal_code }}</p>
                        <p style="color: #666; margin: 0; font-size: 0.9rem; margin-top: 0.5rem;">📞 {{ $order->customer_phone ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h4 style="color: var(--ink); margin-bottom: 1rem; font-weight: 600;">Payment Method</h4>
                    <div style="padding: 1rem; background: var(--light-sage); border-radius: 0.5rem; text-align: center;">
                        <p style="color: var(--ink); font-weight: 600; margin: 0;">{{ ucfirst($order->payment_method) }}</p>
                        <p style="color: #999; font-size: 0.85rem; margin-top: 0.5rem; margin-bottom: 0;">Payment received on {{ $order->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Link -->
        <div style="margin-top: 2rem;">
            <a href="{{ route('user.dashboard') }}" style="color: var(--accent); text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;font-size: 1rem;">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>
@endsection
