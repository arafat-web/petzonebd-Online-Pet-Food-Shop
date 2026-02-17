@extends('client.master')

@section('title')
    My Dashboard - Pet Zone
@endsection

@section('content')
    <!-- ══════════ BREADCRUMB ══════════ -->
    <div style="background: #f9f9f9; border-bottom: 1px solid var(--border); padding: 1rem 0;">
        <div class="container-xl">
            <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="breadcrumb-item"><a href="{{route('index')}}" style="color: var(--accent); text-decoration: none;">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color: var(--ink);">My Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- ══════════ PAGE HEADER ══════════ -->
    <div style="background: var(--light-sage); padding: 2rem 0;" class="mb-5">
        <div class="container-xl">
            <h1 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 6vw, 3rem); color: var(--ink); margin: 0;">
                Welcome <em style="color: var(--accent); font-style: normal;">{{ auth()->user()->name }}!</em>
            </h1>
            <p style="color: #666; margin-top: 0.5rem; margin-bottom: 0;">Manage your account and orders</p>
        </div>
    </div>

    <!-- ══════════ DASHBOARD CONTENT ══════════ -->
    <div class="container-xl mb-5">
        <div class="row g-4">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div style="text-align: center; margin-bottom: 2rem;">
                        <div style="width: 80px; height: 80px; background: var(--light-sage); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; margin-bottom: 1rem;">
                            <i class="bi bi-person-fill" style="font-size: 2.5rem; color: var(--accent);"></i>
                        </div>
                        <h3 style="color: var(--ink); margin-bottom: 0.25rem; font-size: 1.1rem;">{{ auth()->user()->name }}</h3>
                        <p style="color: #999; font-size: 0.9rem; margin: 0;">{{ auth()->user()->email }}</p>
                    </div>

                    <hr style="border: none; border-top: 1px solid var(--border); margin: 1.5rem 0;">

                    <nav style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <a href="{{ route('user.dashboard') }}" style="padding: 0.75rem 1rem; background: var(--accent); color: white; border-radius: 0.5rem; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.75rem; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(232,82,26,0.2);" class="dashboard-nav-btn">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <a href="{{ route('user.profile') }}" style="padding: 0.75rem 1rem; background: transparent; color: var(--ink); border: 2px solid var(--border); border-radius: 0.5rem; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.75rem; transition: all 0.3s ease;" class="dashboard-nav-link">
                            <i class="bi bi-person-gear"></i> Edit Profile
                        </a>
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" style="width: 100%; padding: 0.75rem 1rem; background: transparent; color: #d96b1a; border: 2px solid #d96b1a; border-radius: 0.5rem; font-weight: 600; display: flex; align-items: center; gap: 0.75rem; cursor: pointer; transition: all 0.3s ease; font-family: 'DM Sans', sans-serif;" class="dashboard-logout-btn">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </nav>

                    <style>
                        .dashboard-nav-btn:hover {
                            background: #d96b1a;
                            box-shadow: 0 4px 12px rgba(232,82,26,0.3);
                            transform: translateY(-1px);
                        }
                        .dashboard-nav-link:hover {
                            background: var(--light-sage);
                            border-color: var(--sage);
                            transform: translateY(-1px);
                        }
                        .dashboard-logout-btn:hover {
                            background: rgba(217, 107, 26, 0.1);
                            box-shadow: 0 2px 8px rgba(217, 107, 26, 0.2);
                            transform: translateY(-1px);
                        }
                        .order-table-row:hover {
                            background: rgba(74, 103, 65, 0.05);
                        }
                    </style>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- Quick Stats -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04); text-align: center;">
                            <div style="width: 50px; height: 50px; background: rgba(232,82,26,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; margin-bottom: 1rem;">
                                <i class="bi bi-bag-check" style="font-size: 1.5rem; color: var(--accent);"></i>
                            </div>
                            <p style="color: #999; font-size: 0.9rem; margin-bottom: 0.5rem;">Total Orders</p>
                            <h2 style="color: var(--ink); margin: 0; font-size: 2rem;">{{ $orders->total() }}</h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04); text-align: center;">
                            <div style="width: 50px; height: 50px; background: rgba(74,103,65,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; margin-bottom: 1rem;">
                                <i class="bi bi-check-circle" style="font-size: 1.5rem; color: var(--sage);"></i>
                            </div>
                            <p style="color: #999; font-size: 0.9rem; margin-bottom: 0.5rem;">Completed</p>
                            <h2 style="color: var(--ink); margin: 0; font-size: 2rem;">{{ $orders->where('status', 'completed')->count() }}</h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04); text-align: center;">
                            <div style="width: 50px; height: 50px; background: rgba(255,193,7,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; margin-bottom: 1rem;">
                                <i class="bi bi-hourglass-split" style="font-size: 1.5rem; color: #ffc107;"></i>
                            </div>
                            <p style="color: #999; font-size: 0.9rem; margin-bottom: 0.5rem;">Pending</p>
                            <h2 style="color: var(--ink); margin: 0; font-size: 2rem;">{{ $orders->where('status', 'pending')->count() }}</h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04); text-align: center;">
                            <div style="width: 50px; height: 50px; background: rgba(0,0,0,0.05); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; margin-bottom: 1rem;">
                                <i class="bi bi-wallet2" style="font-size: 1.5rem; color: var(--ink);"></i>
                            </div>
                            <p style="color: #999; font-size: 0.9rem; margin-bottom: 0.5rem;">Total Spent</p>
                            <h2 style="color: var(--ink); margin: 0; font-size: 1.8rem;">৳{{ number_format($orders->sum('total'), 0) }}</h2>
                        </div>
                    </div>
                </div>

                <!-- Orders Section Header -->
                <div style="margin-bottom: 2rem;">
                    <h2 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.8rem; color: var(--ink); margin-bottom: 0.5rem; letter-spacing: 1px;">My Orders</h2>
                    <p style="color: #999; margin: 0;">View and manage all your orders</p>
                </div>

                <!-- Recent Orders -->
                <div class="card-bg rounded-3 p-4" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 style="color: var(--ink); margin-bottom: 1.5rem; font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem;">Recent Orders</h3>

                    @if($orders->count() > 0)
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="border-bottom: 2px solid var(--border);">
                                        <th style="padding: 1rem; text-align: left; color: var(--ink); font-weight: 600;">Order ID</th>
                                        <th style="padding: 1rem; text-align: left; color: var(--ink); font-weight: 600;">Date</th>
                                        <th style="padding: 1rem; text-align: left; color: var(--ink); font-weight: 600;">Items</th>
                                        <th style="padding: 1rem; text-align: left; color: var(--ink); font-weight: 600;">Total</th>
                                        <th style="padding: 1rem; text-align: left; color: var(--ink); font-weight: 600;">Status</th>
                                        <th style="padding: 1rem; text-align: left; color: var(--ink); font-weight: 600;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr style="border-bottom: 1px solid var(--border); transition: background 0.3s ease;" class="order-table-row">
                                            <td style="padding: 1rem; color: #666;">
                                                <strong style="color: var(--accent);">#{{ $order->order_number }}</strong>
                                            </td>
                                            <td style="padding: 1rem; color: #666;">
                                                {{ $order->created_at->format('d M Y') }}
                                            </td>
                                            <td style="padding: 1rem; color: #666;">
                                                {{ $order->items->count() }} item(s)
                                            </td>
                                            <td style="padding: 1rem; color: var(--ink); font-weight: 600;">
                                                ৳{{ number_format($order->total, 0) }}
                                            </td>
                                            <td style="padding: 1rem;">
                                                @if($order->status === 'completed')
                                                    <span style="display: inline-block; padding: 0.5rem 1rem; background: rgba(74,103,65,0.1); color: var(--sage); border-radius: 0.5rem; font-size: 0.85rem; font-weight: 600;">
                                                        <i class="bi bi-check-circle"></i> Completed
                                                    </span>
                                                @elseif($order->status === 'pending')
                                                    <span style="display: inline-block; padding: 0.5rem 1rem; background: rgba(255,193,7,0.1); color: #ffc107; border-radius: 0.5rem; font-size: 0.85rem; font-weight: 600;">
                                                        <i class="bi bi-hourglass-split"></i> Pending
                                                    </span>
                                                @else
                                                    <span style="display: inline-block; padding: 0.5rem 1rem; background: rgba(0,0,0,0.05); color: var(--ink); border-radius: 0.5rem; font-size: 0.85rem; font-weight: 600;">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td style="padding: 1rem;">
                                                <a href="{{ route('user.order-details', $order->id) }}" style="color: var(--accent); text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; transition: color 0.3s ease;" onmouseover="this.style.color='#d96b1a'" onmouseout="this.style.color='var(--accent)'">
                                                    View <i class="bi bi-arrow-right"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div style="margin-top: 2rem;">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <div style="text-align: center; padding: 3rem 1rem;">
                            <div style="width: 80px; height: 80px; background: var(--light-sage); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; margin-bottom: 1rem;">
                                <i class="bi bi-bag" style="font-size: 2rem; color: #999;"></i>
                            </div>
                            <h3 style="color: var(--ink); margin-bottom: 0.5rem;">No Orders Yet</h3>
                            <p style="color: #999; margin-bottom: 1.5rem;">You haven't placed any orders yet.</p>
                            <a href="{{ route('index') }}" style="display: inline-block; padding: 0.75rem 1.5rem; background: var(--accent); color: white; border-radius: 0.5rem; text-decoration: none; font-weight: 600; transition: background 0.3s ease;" onmouseover="this.style.background='#d96b1a'" onmouseout="this.style.background='var(--accent)'">
                                Start Shopping
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
