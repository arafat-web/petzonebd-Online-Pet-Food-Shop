@extends('client.master')

@section('title')
    Checkout
@endsection

@section('content')
    <!-- ══════════ BREADCRUMB ══════════ -->
    <div class="navigation py-3 py-md-4">
        <div class="container-xl">
            <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('cart.list')}}">Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- ══════════ PAGE HEADER ══════════ -->
    <div style="background: var(--light-sage); padding: 3rem 0;" class="mb-5">
        <div class="container-xl">
            <h1 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 6vw, 3rem); color: var(--ink); margin: 0;">
                Checkout <em style="color: var(--accent); font-style: normal;">Form</em>
            </h1>
            <p style="color: #666; margin-top: 0.5rem; margin-bottom: 0;">Complete your order in simple steps</p>
        </div>
    </div>

    <!-- ══════════ CHECKOUT FORM ══════════ -->
    <div class="container-xl mb-5">
        <div class="row g-4">
            <!-- Checkout Form -->
            <div class="col-lg-8">
                <form action="{{ route('checkout.store') }}" method="POST" class="card-bg rounded-3 p-4 p-md-5" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    @csrf
                    
                    <!-- Customer Information -->
                    <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem; color: var(--ink); margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid var(--accent);">
                        Customer <em style="color: var(--accent); font-style: normal;">Information</em>
                    </h3>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Full Name *</label>
                            <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') }}" required style="border-color: var(--border); padding: 0.75rem; border-radius: 0.5rem;">
                            @error('customer_name')<span class="text-danger" style="font-size: 0.85rem;">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Email Address *</label>
                            <input type="email" name="customer_email" class="form-control @error('customer_email') is-invalid @enderror" value="{{ old('customer_email', auth()->user()?->email) }}" required style="border-color: var(--border); padding: 0.75rem; border-radius: 0.5rem;">
                            @error('customer_email')<span class="text-danger" style="font-size: 0.85rem;">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Phone Number *</label>
                            <input type="tel" name="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" value="{{ old('customer_phone') }}" placeholder="+880 1XXXXXXXXX" required style="border-color: var(--border); padding: 0.75rem; border-radius: 0.5rem;">
                            @error('customer_phone')<span class="text-danger" style="font-size: 0.85rem;">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem; color: var(--ink); margin-bottom: 1.5rem; margin-top: 2.5rem; padding-bottom: 1rem; border-bottom: 2px solid var(--accent);">
                        Shipping <em style="color: var(--accent); font-style: normal;">Address</em>
                    </h3>

                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Street Address *</label>
                            <input type="text" name="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" value="{{ old('shipping_address') }}" placeholder="House No., Road, Area" required style="border-color: var(--border); padding: 0.75rem; border-radius: 0.5rem;">
                            @error('shipping_address')<span class="text-danger" style="font-size: 0.85rem;">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-8">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">City *</label>
                            <input type="text" name="shipping_city" class="form-control @error('shipping_city') is-invalid @enderror" value="{{ old('shipping_city') }}" placeholder="Dhaka, Chittagong, etc." required style="border-color: var(--border); padding: 0.75rem; border-radius: 0.5rem;">
                            @error('shipping_city')<span class="text-danger" style="font-size: 0.85rem;">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Postal Code</label>
                            <input type="text" name="shipping_postal_code" class="form-control" value="{{ old('shipping_postal_code') }}" style="border-color: var(--border); padding: 0.75rem; border-radius: 0.5rem;">
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem; color: var(--ink); margin-bottom: 1.5rem; margin-top: 2.5rem; padding-bottom: 1rem; border-bottom: 2px solid var(--accent);">
                        Payment <em style="color: var(--accent); font-style: normal;">Method</em>
                    </h3>

                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 1rem; display: block; font-size: 0.9rem;">Select Payment Method *</label>
                            @foreach(['cod' => 'Cash on Delivery', 'bkash' => 'bKash', 'nagad' => 'Nagad', 'card' => 'Credit/Debit Card'] as $value => $label)
                                <div style="display: flex; align-items: center; padding: 1rem; border: 2px solid var(--border); border-radius: 0.5rem; margin-bottom: 0.75rem; cursor: pointer; transition: all 0.2s;" class="payment-option" onchange="updatePaymentOption('{{ $value }}')">
                                    <input type="radio" name="payment_method" value="{{ $value }}" id="payment_{{ $value }}" @if(old('payment_method') === $value) checked @elseif($loop->first) checked @endif required style="margin-right: 0.75rem;">
                                    <label for="payment_{{ $value }}" style="margin: 0; cursor: pointer; flex: 1;">
                                        <strong style="color: var(--ink);">{{ $label }}</strong>
                                        @if($value === 'cod')
                                            <p style="color: #999; font-size: 0.85rem; margin-top: 0.25rem; margin-bottom: 0;">Pay when you receive your order</p>
                                        @elseif($value === 'bkash')
                                            <p style="color: #999; font-size: 0.85rem; margin-top: 0.25rem; margin-bottom: 0;">Quick payment via bKash</p>
                                        @elseif($value === 'nagad')
                                            <p style="color: #999; font-size: 0.85rem; margin-top: 0.25rem; margin-bottom: 0;">Quick payment via Nagad</p>
                                        @else
                                            <p style="color: #999; font-size: 0.85rem; margin-top: 0.25rem; margin-bottom: 0;">Visa, Mastercard accepted</p>
                                        @endif
                                    </label>
                                </div>
                            @endforeach
                            @error('payment_method')<span class="text-danger" style="font-size: 0.85rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <!-- Special Notes -->
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Special Instructions (Optional)</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Any special delivery instructions..." style="border-color: var(--border); padding: 0.75rem; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif;">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <button type="submit" style="background: var(--accent); color: white; border: none; padding: 1rem 2.5rem; border-radius: 0.5rem; font-weight: 700; cursor: pointer; font-family: 'Bebas Neue', sans-serif; letter-spacing: 2px; font-size: 1rem; text-transform: uppercase; width: 100%;">
                        <i class="bi bi-credit-card me-2"></i> Place Order
                    </button>
                </form>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="col-lg-4">
                <div class="card-bg rounded-3 p-4 p-md-5" style="position: sticky; top: 90px; border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem; color: var(--ink); margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid var(--accent);">
                        Order <em style="color: var(--accent); font-style: normal;">Summary</em>
                    </h3>

                    <!-- Order Items -->
                    <div style="margin-bottom: 1.5rem; max-height: 300px; overflow-y: auto;">
                        @foreach($cartItems as $item)
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; padding-bottom: 0.75rem; margin-bottom: 0.75rem; border-bottom: 1px solid var(--border);">
                                <div style="flex: 1;">
                                    <div style="color: var(--ink); font-weight: 600; font-size: 0.9rem;">{{ $item->name }}</div>
                                    <div style="color: #999; font-size: 0.8rem;">Qty: {{ $item->quantity }}</div>
                                </div>
                                <div style="color: var(--ink); font-weight: 700; text-align: right;">৳{{ $item->price * $item->quantity }}</div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pricing Breakdown -->
                    <div style="padding-top: 1rem; border-top: 2px solid var(--border);">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                            <span style="color: #666;">Subtotal</span>
                            <span style="color: var(--ink); font-weight: 600;">৳{{ number_format($total, 2) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                            <span style="color: #666;">Shipping</span>
                            <span style="color: var(--sage); font-weight: 600;">Free</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 1.5rem; padding-top: 0.75rem; border-top: 1px solid var(--border);">
                            <span style="color: var(--ink); font-weight: 700; font-size: 1.1rem;">Total</span>
                            <span style="color: var(--accent); font-weight: 700; font-family: 'Bebas Neue', sans-serif; font-size: 1.5rem;">৳{{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <!-- Trust Badges -->
                    <div style="background: rgba(74,103,65,0.08); border: 1px solid var(--sage); border-radius: 0.5rem; padding: 1rem; font-size: 0.8rem; color: #666; text-align: center; line-height: 1.8;">
                        <p style="margin: 0;">
                            <i class="bi bi-shield-check" style="color: var(--sage); margin-right: 0.5rem;"></i>Secure Payment<br>
                            <i class="bi bi-truck" style="color: var(--sage); margin-right: 0.5rem;"></i>Fast Delivery<br>
                            <i class="bi bi-arrow-return-left" style="color: var(--sage); margin-right: 0.5rem;"></i>Easy Returns
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                this.style.borderColor = 'var(--accent)';
                this.style.backgroundColor = 'rgba(232,82,26,0.05)';
                document.querySelectorAll('.payment-option').forEach(opt => {
                    if(opt !== this) {
                        opt.style.borderColor = 'var(--border)';
                        opt.style.backgroundColor = 'transparent';
                    }
                });
            });
        });
    </script>
@endsection
