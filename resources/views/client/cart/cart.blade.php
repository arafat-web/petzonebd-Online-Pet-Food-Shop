@extends('client.master')

@section('bg-color')
@endsection

@section('title')
    Shopping Cart
@endsection

@section('content')
    <!-- ══════════ BREADCRUMB ══════════ -->
    <div class="navigation py-3 py-md-4">
        <div class="container-xl">
            <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- ══════════ PAGE HEADER ══════════ -->
    <div style="background: var(--light-sage); padding: 3rem 0;" class="mb-5">
        <div class="container-xl">
            <h1 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 6vw, 3rem); color: var(--ink); margin: 0;">
                Shopping <em style="color: var(--accent); font-style: normal;">Cart</em>
            </h1>
            <p style="color: #666; margin-top: 0.5rem; margin-bottom: 0;">Review and manage your items</p>
        </div>
    </div>

    <!-- ══════════ ALERT ══════════ -->
    @if ($message = Session::get('cartsuccess'))
        <div class="container-xl mb-4">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(74,103,65,0.1); border: 1px solid var(--sage); color: var(--sage);">
                <i class="bi bi-check-circle me-2"></i> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- ══════════ CART CONTENT ══════════ -->
    <div class="container-xl mb-5">
        <div class="row g-4">
            <!-- Cart Items -->
            <div class="col-lg-9">
                @if(count($cartItems) > 0)
                    <div class="card-bg rounded-3 p-4 p-md-5" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <div class="table-responsive">
                            <table class="table table-borderless" style="font-family: 'DM Sans', sans-serif;">
                                <thead>
                                    <tr style="border-bottom: 2px solid var(--border); color: var(--ink);">
                                        <th scope="col" style="font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Image</th>
                                        <th scope="col" style="font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Product</th>
                                        <th scope="col" style="font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Qty</th>
                                        <th scope="col" style="font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Price</th>
                                        <th scope="col" class="d-none d-md-table-cell" style="font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                    <tr style="border-bottom: 1px solid rgba(26,26,24,0.08); padding: 1.5rem 0;">
                                        <td style="padding: 1.5rem 0.5rem;">
                                            <div style="background: #f5f5f5; padding: 0.5rem; border-radius: 0.5rem; display: inline-block;">
                                                <img src="{{$item->attributes->image}}" class="img-fluid" style="max-width: 80px; max-height: 80px; object-fit: contain;">
                                            </div>
                                        </td>
                                        <td style="padding: 1.5rem 1rem; color: var(--ink); font-weight: 500; vertical-align: middle;">
                                            {{ $item->name }}
                                        </td>
                                        <td style="padding: 1.5rem 1rem; vertical-align: middle;">
                                            <form class="d-inline" action="{{ route('cart.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id}}">
                                                <div style="display: flex; align-items: center; gap: 0.5rem; border: 1px solid var(--border); border-radius: 0.5rem; width: fit-content;">
                                                    <button type="submit" style="background: transparent; border: none; padding: 0.35rem 0.5rem; cursor: pointer; color: var(--ink);" title="Update">
                                                        <i class="bi bi-arrow-repeat" style="font-size: 0.9rem;"></i>
                                                    </button>
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" style="width: 50px; border: none; outline: none; text-align: center; padding: 0.35rem 0; background: transparent;" min="1">
                                                </div>
                                            </form>
                                        </td>
                                        <td style="padding: 1.5rem 1rem; color: var(--ink); font-weight: 700; vertical-align: middle;">
                                            ৳{{ $item->price * $item->quantity }}
                                            <small style="display: block; color: #999; font-weight: 400; font-size: 0.85rem;">৳{{ $item->price }} each</small>
                                        </td>
                                        <td class="d-none d-md-table-cell" style="padding: 1.5rem 0.5rem; text-align: right; vertical-align: middle;">
                                            <form class="d-inline" action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}" name="id">
                                                <button style="background: rgba(232,82,26,0.1); color: var(--accent); border: 1px solid rgba(232,82,26,0.3); padding: 0.5rem 0.75rem; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s;">
                                                    <i class="bi bi-trash3" style="font-size: 0.9rem;"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 pt-3" style="border-top: 1px solid var(--border);">
                            <a href="{{ route('products', ['category' => 'cat-food']) }}" style="color: var(--accent); text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                                <i class="bi bi-arrow-left"></i> Continue Shopping
                            </a>
                        </div>
                    </div>
                @else
                    <div class="card-bg rounded-3 p-5" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04); text-align: center;">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">🛒</div>
                        <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.5rem; color: var(--ink);">Your Cart is Empty</h3>
                        <p style="color: #666; margin-bottom: 2rem;">Start shopping to add items to your cart!</p>
                        <a href="{{ route('products', ['category' => 'cat-food']) }}" style="background: var(--accent); color: white; padding: 0.75rem 2rem; border-radius: 0.5rem; text-decoration: none; font-weight: 600; display: inline-block;">
                            Shop Now <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                @endif
            </div>

            <!-- Order Summary -->
            <div class="col-lg-3">
                <div class="card-bg rounded-3 p-4 p-md-5" style="position: sticky; top: 90px; border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem; color: var(--ink); margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid var(--accent);">
                        Order <em style="color: var(--accent); font-style: normal;">Summary</em>
                    </h3>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border);">
                        <span style="color: #666; font-size: 0.95rem;">Subtotal</span>
                        <span style="color: var(--ink); font-weight: 600;">৳{{ Cart::getTotal() }}</span>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border);">
                        <span style="color: #666; font-size: 0.95rem;">Shipping</span>
                        <span style="color: var(--sage); font-weight: 600;">Free</span>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 2rem; font-size: 1.2rem;">
                        <span style="color: var(--ink); font-weight: 700;">Total</span>
                        <span style="color: var(--accent); font-weight: 700; font-family: 'Bebas Neue', sans-serif; font-size: 1.5rem;">৳{{ Cart::getTotal() }}</span>
                    </div>
                    
                    <div style="display: grid; gap: 0.75rem; margin-bottom: 1.5rem;">
                        <a href="{{ route('checkout.index') }}" style="background: var(--accent); color: white; border: none; padding: 0.9rem 1.5rem; border-radius: 0.5rem; font-weight: 700; cursor: pointer; font-family: 'Bebas Neue', sans-serif; letter-spacing: 1.5px; font-size: 0.9rem; text-transform: uppercase; transition: background 0.2s; text-decoration: none; text-align: center; display: block;">
                            <i class="bi bi-credit-card me-2"></i> Proceed to Checkout
                        </a>
                        <a href="{{ route('products', ['category' => 'cat-food']) }}" style="background: transparent; color: var(--ink); border: 2px solid var(--border); padding: 0.9rem 1.5rem; border-radius: 0.5rem; font-weight: 700; text-decoration: none; text-align: center; font-family: 'Bebas Neue', sans-serif; letter-spacing: 1.5px; font-size: 0.9rem; text-transform: uppercase; transition: all 0.2s; display: block;">
                            <i class="bi bi-shop me-2"></i> Continue Shopping
                        </a>
                    </div>

                    <div style="background: rgba(74,103,65,0.08); border: 1px solid var(--sage); border-radius: 0.5rem; padding: 1rem; font-size: 0.8rem; color: #666; text-align: center; line-height: 1.6;">
                        <p style="margin: 0;"><i class="bi bi-shield-check" style="color: var(--sage); margin-right: 0.5rem;"></i>Secure checkout<br><i class="bi bi-truck" style="color: var(--sage); margin-right: 0.5rem;"></i>Fast delivery<br><i class="bi bi-arrow-return-left" style="color: var(--sage); margin-right: 0.5rem;"></i>Money-back guarantee</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
