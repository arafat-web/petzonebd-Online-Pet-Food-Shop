@extends('client.master')

@section('title')
    Edit Profile - Pet Zone
@endsection

@section('content')
    <!-- ══════════ BREADCRUMB ══════════ -->
    <div style="background: #f9f9f9; border-bottom: 1px solid var(--border); padding: 1rem 0;">
        <div class="container-xl">
            <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="breadcrumb-item"><a href="{{route('index')}}" style="color: var(--accent); text-decoration: none;">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}" style="color: var(--accent); text-decoration: none;">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color: var(--ink);">Edit Profile</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- ══════════ PAGE HEADER ══════════ -->
    <div style="background: var(--light-sage); padding: 2rem 0;" class="mb-5">
        <div class="container-xl">
            <h1 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 6vw, 3rem); color: var(--ink); margin: 0;">
                Edit <em style="color: var(--accent); font-style: normal;">Profile</em>
            </h1>
            <p style="color: #666; margin-top: 0.5rem; margin-bottom: 0;">Update your account information</p>
        </div>
    </div>

    <!-- ══════════ PROFILE FORM ══════════ -->
    <div class="container-xl mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card-bg rounded-3 p-4 p-md-5" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <!-- Success Messages -->
                    @if (session('success'))
                        <div style="background: rgba(74,103,65,0.1); border: 1px solid var(--sage); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.5rem;">
                            <p style="color: var(--sage); font-size: 0.9rem; margin: 0;">
                                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                            </p>
                        </div>
                    @endif

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

                    <form method="POST" action="{{ route('user.update-profile') }}">
                        @csrf

                        <!-- Full Name -->
                        <div class="mb-4">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid @error('name') rgba(232,82,26,0.5) @else var(--border) @enderror; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif;">
                            @error('name')
                                <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid @error('email') rgba(232,82,26,0.5) @else var(--border) @enderror; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif;">
                            @error('email')
                                <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-4">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Phone Number</label>
                            <input type="tel" name="phone" value="{{ old('phone', $user->phone ?? '') }}" placeholder="+880 1XXXXXXXXX" style="width: 100%; padding: 0.75rem; border: 1px solid @error('phone') rgba(232,82,26,0.5) @else var(--border) @enderror; border-radius: 0.5rem; font-family: 'DM Sans', sans-serif;">
                            @error('phone')
                                <span style="color: var(--accent); font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Member Since -->
                        <div class="mb-4">
                            <label style="font-weight: 600; color: var(--ink); margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">Member Since</label>
                            <div style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 0.5rem; background: #f9f9f9; color: #666;">
                                {{ $user->created_at->format('d M Y - h:i A') }}
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" style="width: 100%; padding: 0.85rem; background: var(--accent); color: white; border: none; border-radius: 0.5rem; font-weight: 600; font-family: 'DM Sans', sans-serif; cursor: pointer; font-size: 1rem; transition: background 0.3s ease;" onmouseover="this.style.background='#d96b1a'" onmouseout="this.style.background='var(--accent)'">
                            <i class="bi bi-check-circle me-2"></i> Save Changes
                        </button>
                    </form>

                    <!-- Back Link -->
                    <div style="text-align: center; margin-top: 1.5rem;">
                        <a href="{{ route('user.dashboard') }}" style="color: var(--accent); text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                            <i class="bi bi-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
