@extends('client.master')

@section('title')
    Register - Pet Zone
@endsection

@section('content')
    <!-- ══════════ BREADCRUMB ══════════ -->
    <div class="navigation py-3 py-md-4">
        <div class="container-xl">
            <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Register</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- ══════════ PAGE HEADER ══════════ -->
    <div style="background: var(--light-sage); padding: 2rem 0;" class="mb-5">
        <div class="container-xl">
            <h1 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 6vw, 3rem); color: var(--ink); margin: 0;">
                Join <em style="color: var(--accent); font-style: normal;">Pet Zone!</em>
            </h1>
            <p style="color: #666; margin-top: 0.5rem; margin-bottom: 0;">Create your account and start shopping</p>
        </div>
    </div>

    <!-- ══════════ REGISTER FORM ══════════ -->
    <div class="container-xl mb-5">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-6">
                <div class="card-bg rounded-3 p-4 p-md-5" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <!-- Logo -->
                    <div style="text-align: center; margin-bottom: 2rem;">
                        <div style="font-family: 'Bebas Neue', sans-serif; font-size: 2rem; color: var(--ink); letter-spacing: 2px;">
                            Pet<span style="color: var(--accent);">Zone</span>
                        </div>
                        <p style="color: #999; font-size: 0.9rem; margin-top: 0.5rem;">Create your account in seconds</p>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div style="background: rgba(232,82,26,0.1); border: 1px solid rgba(232,82,26,0.3); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.5rem;">
                            @foreach ($errors->all() as $error)
                                <p style="color: var(--accent); font-size: 0.9rem; margin: 0.5rem 0;">
                                    <i class="bi bi-exclamation-circle me-2"></i> {{ $error }}
                                </p>
                            @endforeach
                        </div>
                    @endif

                    <!-- Register Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Full Name -->
                        <div class="mb-4">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required autofocus style="width: 100%; padding: 0.75rem; border: 1px solid @error('name') rgba(232,82,26,0.5) @else var(--border) @enderror; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif;">
                            @error('name')
                                <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 0.75rem; border: 1px solid @error('email') rgba(232,82,26,0.5) @else var(--border) @enderror; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif;">
                            @error('email')
                                <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Password</label>
                            <input type="password" name="password" required style="width: 100%; padding: 0.75rem; border: 1px solid @error('password') rgba(232,82,26,0.5) @else var(--border) @enderror; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif;">
                            @error('password')
                                <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                            <p style="color: #999; font-size: 0.8rem; margin-top: 0.25rem; margin-bottom: 0;">At least 8 characters with uppercase and numbers</p>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Confirm Password</label>
                            <input type="password" name="password_confirmation" required style="width: 100%; padding: 0.75rem; border: 1px solid @error('password_confirmation') rgba(232,82,26,0.5) @else var(--border) @enderror; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif;">
                            @error('password_confirmation')
                                <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="mb-4" style="display: flex; align-items: flex-start; gap: 0.5rem;">
                            <input type="checkbox" id="terms" name="terms" value="1" required style="width: 18px; height: 18px; margin-top: 2px; cursor: pointer; flex-shrink: 0;">
                            <label for="terms" style="margin: 0; color: #666; font-size: 0.85rem; cursor: pointer;">
                                I agree to the <a href="#" style="color: var(--accent); text-decoration: none;">Terms & Conditions</a> and <a href="#" style="color: var(--accent); text-decoration: none;">Privacy Policy</a>
                            </label>
                        </div>

                        <!-- Register Button -->
                        <button type="submit" style="width: 100%; padding: 0.85rem; background: var(--accent); color: white; border: none; border-radius: 0.5rem; font-weight: 600; font-family: 'DM Sans', sans-serif; cursor: pointer; font-size: 1rem; transition: background 0.3s ease;" onmouseover="this.style.background='#d96b1a'" onmouseout="this.style.background='var(--accent)'">
                            Create Account
                        </button>
                    </form>

                    <!-- Divider -->
                    <div style="text-align: center; margin: 2rem 0; position: relative;">
                        <div style="border-top: 1px solid var(--border);"></div>
                        <span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: white; padding: 0 1rem; color: #999; font-size: 0.9rem;">Already have an account?</span>
                    </div>

                    <!-- Login Link -->
                    <div style="text-align: center;">
                        <p style="margin: 0; color: #666; font-size: 0.95rem;">
                            <a href="{{ route('client.login') }}" style="color: var(--accent); text-decoration: none; font-weight: 600;">Sign in here</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Benefits Sidebar (Desktop Only) -->
            <div class="col-lg-4" style="display: none;" class="d-none d-lg-block">
                <div style="padding: 0 2rem;">
                    <h3 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.5rem; color: var(--ink); margin-bottom: 2rem;">Why Join Pet Zone?</h3>

                    <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
                        <div style="background: var(--light-sage); width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="bi bi-lightning-fill" style="font-size: 1.5rem; color: var(--accent);"></i>
                        </div>
                        <div>
                            <h4 style="font-weight: 600; color: var(--ink); margin-bottom: 0.25rem; font-size: 0.95rem;">Quick Checkout</h4>
                            <p style="color: #666; font-size: 0.85rem; margin: 0;">Save your details for faster orders</p>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
                        <div style="background: var(--light-sage); width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="bi bi-heart" style="font-size: 1.5rem; color: var(--accent);"></i>
                        </div>
                        <div>
                            <h4 style="font-weight: 600; color: var(--ink); margin-bottom: 0.25rem; font-size: 0.95rem;">Wishlist & Favorites</h4>
                            <p style="color: #666; font-size: 0.85rem; margin: 0;">Keep track of your favorite products</p>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
                        <div style="background: var(--light-sage); width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="bi bi-gift" style="font-size: 1.5rem; color: var(--accent);"></i>
                        </div>
                        <div>
                            <h4 style="font-weight: 600; color: var(--ink); margin-bottom: 0.25rem; font-size: 0.95rem;">Exclusive Deals</h4>
                            <p style="color: #666; font-size: 0.85rem; margin: 0;">Get special offers and discounts</p>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem;">
                        <div style="background: var(--light-sage); width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="bi bi-box" style="font-size: 1.5rem; color: var(--accent);"></i>
                        </div>
                        <div>
                            <h4 style="font-weight: 600; color: var(--ink); margin-bottom: 0.25rem; font-size: 0.95rem;">Order History</h4>
                            <p style="color: #666; font-size: 0.85rem; margin: 0;">Track and manage all your orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
