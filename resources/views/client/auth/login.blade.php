@extends('client.master')

@section('title')
    Login - Pet Zone
@endsection

@section('content')
    <!-- ══════════ BREADCRUMB ══════════ -->
    <div class="navigation py-3 py-md-4">
        <div class="container-xl">
            <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Login</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- ══════════ PAGE HEADER ══════════ -->
    <div style="background: var(--light-sage); padding: 2rem 0;" class="mb-5">
        <div class="container-xl">
            <h1 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 6vw, 3rem); color: var(--ink); margin: 0;">
                Welcome <em style="color: var(--accent); font-style: normal;">Back!</em>
            </h1>
            <p style="color: #666; margin-top: 0.5rem; margin-bottom: 0;">Sign in to your account</p>
        </div>
    </div>

    <!-- ══════════ LOGIN FORM ══════════ -->
    <div class="container-xl mb-5">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-6">
                <div class="card-bg rounded-3 p-4 p-md-5" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <!-- Logo -->
                    <div style="text-align: center; margin-bottom: 2rem;">
                        <div style="font-family: 'Bebas Neue', sans-serif; font-size: 2rem; color: var(--ink); letter-spacing: 2px;">
                            Pet<span style="color: var(--accent);">Zone</span>
                        </div>
                        <p style="color: #999; font-size: 0.9rem; margin-top: 0.5rem;">Your trusted pet food store</p>
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

                    <!-- Session Success -->
                    @if (session('status'))
                        <div style="background: rgba(74,103,65,0.1); border: 1px solid var(--sage); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.5rem;">
                            <p style="color: var(--sage); font-size: 0.9rem; margin: 0;">
                                <i class="bi bi-check-circle me-2"></i> {{ session('status') }}
                            </p>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus style="width: 100%; padding: 0.75rem; border: 1px solid @error('email') rgba(232,82,26,0.5) @else var(--border) @enderror; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif;">
                            @error('email')
                                <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-2">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Password</label>
                            <input type="password" name="password" required style="width: 100%; padding: 0.75rem; border: 1px solid @error('password') rgba(232,82,26,0.5) @else var(--border) @enderror; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif;">
                            @error('password')
                                <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-4" style="display: flex; align-items: center; gap: 0.5rem;">
                            <input type="checkbox" id="remember" name="remember" value="1" style="width: 18px; height: 18px; cursor: pointer;">
                            <label for="remember" style="margin: 0; color: #666; font-size: 0.9rem; cursor: pointer;">Remember me</label>
                        </div>

                        <!-- Forgot Password Link -->
                        @if (Route::has('password.request'))
                            <div style="text-align: right; margin-bottom: 1.5rem;">
                                <a href="{{ route('password.request') }}" style="color: var(--accent); text-decoration: none; font-size: 0.9rem; font-weight: 500;">
                                    Forgot password?
                                </a>
                            </div>
                        @endif

                        <!-- Login Button -->
                        <button type="submit" style="background: var(--accent); color: white; border: none; padding: 0.9rem 2rem; border-radius: 0.5rem; font-weight: 700; cursor: pointer; font-family: 'Bebas Neue', sans-serif; letter-spacing: 1.5px; font-size: 1rem; text-transform: uppercase; width: 100%; transition: background 0.2s;">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
                        </button>
                    </form>

                    <!-- Divider -->
                    <div style="display: flex; align-items: center; margin: 2rem 0; gap: 1rem;">
                        <div style="flex: 1; height: 1px; background: var(--border);"></div>
                        <span style="color: #999; font-size: 0.85rem;">Or</span>
                        <div style="flex: 1; height: 1px; background: var(--border);"></div>
                    </div>

                    <!-- Register Link -->
                    <div style="text-align: center; padding: 1.5rem; background: rgba(74,103,65,0.05); border-radius: 0.5rem; border: 1px solid rgba(74,103,65,0.1);">
                        <p style="margin: 0; color: #666; font-size: 0.9rem;">
                            Don't have an account?
                            <a href="{{ route('client.register') }}" style="color: var(--accent); text-decoration: none; font-weight: 700;">
                                Create one now
                            </a>
                        </p>
                    </div>

                    <!-- Test Credentials Info -->
                    <div style="margin-top: 1.5rem; padding: 1rem; background: rgba(0,0,0,0.02); border-radius: 0.5rem; font-size: 0.8rem; color: #999;">
                        <p style="margin: 0 0 0.5rem 0; font-weight: 600;">Test Credentials:</p>
                        <p style="margin: 0 0 0.25rem 0;">📧 admin@petzone.com / admin@123</p>
                        <p style="margin: 0;">📧 test@petzone.com / test@123</p>
                    </div>
                </div>
            </div>

            <!-- Benefits Sidebar -->
            <div class="col-lg-5 d-md-none d-lg-block">
                <div style="padding: 2rem 1rem;">
                    <!-- Benefit 1 -->
                    <div class="mb-4">
                        <div style="display: flex; align-items: flex-start; gap: 1rem;">
                            <div style="width: 50px; height: 50px; background: rgba(74,103,65,0.15); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-box-seam" style="font-size: 1.5rem; color: var(--sage);"></i>
                            </div>
                            <div>
                                <h4 style="font-family: 'Bebas Neue', sans-serif; font-size: 1rem; color: var(--ink); margin-bottom: 0.5rem;">Quick Checkout</h4>
                                <p style="color: #999; font-size: 0.9rem; margin: 0;">Track your orders and manage preferences.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Benefit 2 -->
                    <div class="mb-4">
                        <div style="display: flex; align-items: flex-start; gap: 1rem;">
                            <div style="width: 50px; height: 50px; background: rgba(232,82,26,0.15); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-suit-heart" style="font-size: 1.5rem; color: var(--accent);"></i>
                            </div>
                            <div>
                                <h4 style="font-family: 'Bebas Neue', sans-serif; font-size: 1rem; color: var(--ink); margin-bottom: 0.5rem;">Wishlist</h4>
                                <p style="color: #999; font-size: 0.9rem; margin: 0;">Save your favorite pet food items.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Benefit 3 -->
                    <div class="mb-4">
                        <div style="display: flex; align-items: flex-start; gap: 1rem;">
                            <div style="width: 50px; height: 50px; background: rgba(74,103,65,0.15); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-percent" style="font-size: 1.5rem; color: var(--sage);"></i>
                            </div>
                            <div>
                                <h4 style="font-family: 'Bebas Neue', sans-serif; font-size: 1rem; color: var(--ink); margin-bottom: 0.5rem;">Exclusive Deals</h4>
                                <p style="color: #999; font-size: 0.9rem; margin: 0;">Get special offers and discounts.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Benefit 4 -->
                    <div>
                        <div style="display: flex; align-items: flex-start; gap: 1rem;">
                            <div style="width: 50px; height: 50px; background: rgba(232,82,26,0.15); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-clock-history" style="font-size: 1.5rem; color: var(--accent);"></i>
                            </div>
                            <div>
                                <h4 style="font-family: 'Bebas Neue', sans-serif; font-size: 1rem; color: var(--ink); margin-bottom: 0.5rem;">Order History</h4>
                                <p style="color: #999; font-size: 0.9rem; margin: 0;">View all your previous purchases.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
