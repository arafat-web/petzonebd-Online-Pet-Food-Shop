@extends('.admin.master')
@php
    $page = 'dashboard'
@endphp
@section('title')
    Dashboard
@endsection
@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Dashboard</h1>
        <p class="admin-page-subtitle">Welcome back! Here's your store overview.</p>
    </div>
    <div class="admin-page-actions">
        <button class="btn btn-outline-secondary">
            <i class="bi bi-download"></i> Export
        </button>
    </div>
</div>

<!-- Stats Cards -->
<div class="admin-stats-grid">
    <!-- Total Products -->
    <div class="admin-stat-card">
        <div class="admin-stat-content">
            <div class="admin-stat-icon" style="background: linear-gradient(135deg, #E8521A 0%, #d96b1a 100%);">
                <i class="bi bi-box2"></i>
            </div>
            <div>
                <p class="admin-stat-label">Total Products</p>
                <h3 class="admin-stat-value">{{ $totalProducts }}</h3>
            </div>
        </div>
        <p class="admin-stat-change {{ $productsChange >= 0 ? 'positive' : 'negative' }}">
            <i class="bi bi-arrow-{{ $productsChange >= 0 ? 'up' : 'down' }}"></i> {{ abs($productsChange) }}% from last month
        </p>
    </div>

    <!-- Total Orders -->
    <div class="admin-stat-card">
        <div class="admin-stat-content">
            <div class="admin-stat-icon" style="background: linear-gradient(135deg, #4A6741 0%, #3d5633 100%);">
                <i class="bi bi-bag-check"></i>
            </div>
            <div>
                <p class="admin-stat-label">Total Orders</p>
                <h3 class="admin-stat-value">{{ $totalOrders }}</h3>
            </div>
        </div>
        <p class="admin-stat-change {{ $ordersChange >= 0 ? 'positive' : 'negative' }}">
            <i class="bi bi-arrow-{{ $ordersChange >= 0 ? 'up' : 'down' }}"></i> {{ abs($ordersChange) }}% from last month
        </p>
    </div>

    <!-- Total Revenue -->
    <div class="admin-stat-card">
        <div class="admin-stat-content">
            <div class="admin-stat-icon" style="background: linear-gradient(135deg, #C4B5A0 0%, #a89783 100%);">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div>
                <p class="admin-stat-label">Total Revenue</p>
                <h3 class="admin-stat-value">৳ {{ number_format($totalRevenue) }}</h3>
            </div>
        </div>
        <p class="admin-stat-change {{ $revenueChange >= 0 ? 'positive' : 'negative' }}">
            <i class="bi bi-arrow-{{ $revenueChange >= 0 ? 'up' : 'down' }}"></i> {{ abs($revenueChange) }}% from last month
        </p>
    </div>

    <!-- Total Customers -->
    <div class="admin-stat-card">
        <div class="admin-stat-content">
            <div class="admin-stat-icon" style="background: linear-gradient(135deg, #2E2E2C 0%, #1a1a18 100%);">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <p class="admin-stat-label">Total Customers</p>
                <h3 class="admin-stat-value">{{ $totalCustomers }}</h3>
            </div>
        </div>
        <p class="admin-stat-change {{ $customersChange >= 0 ? 'positive' : 'negative' }}">
            <i class="bi bi-arrow-{{ $customersChange >= 0 ? 'up' : 'down' }}"></i> {{ abs($customersChange) }}% from last month
        </p>
    </div>
</div>

<!-- Charts & Tables Row -->
<div class="row mt-4">
    <!-- Recent Orders -->
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5 class="mb-0">Recent Orders</h5>
                <a href="#" class="btn-link">View All →</a>
            </div>
            <div class="admin-card-body">
                <div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td><strong>#{{ $order->order_number }}</strong></td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>৳ {{ number_format($order->total) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'delivered' ? 'success' : 'primary') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <p class="text-muted mb-0">No orders yet</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="admin-card-body">
                <a href="{{ route('add.product') }}" class="admin-action-item">
                    <div class="admin-action-icon">
                        <i class="bi bi-plus-circle"></i>
                    </div>
                    <div>
                        <p class="admin-action-title">Add New Product</p>
                        <p class="admin-action-desc">Create a new product listing</p>
                    </div>
                    <i class="bi bi-chevron-right ms-auto"></i>
                </a>

                <a href="{{ route('manage.categories') }}" class="admin-action-item">
                    <div class="admin-action-icon">
                        <i class="bi bi-tags"></i>
                    </div>
                    <div>
                        <p class="admin-action-title">Manage Categories</p>
                        <p class="admin-action-desc">Edit product categories</p>
                    </div>
                    <i class="bi bi-chevron-right ms-auto"></i>
                </a>

                <a href="{{ route('manage.products') }}" class="admin-action-item">
                    <div class="admin-action-icon">
                        <i class="bi bi-boxes"></i>
                    </div>
                    <div>
                        <p class="admin-action-title">View Products</p>
                        <p class="admin-action-desc">See all your products</p>
                    </div>
                    <i class="bi bi-chevron-right ms-auto"></i>
                </a>

                <a href="#" class="admin-action-item">
                    <div class="admin-action-icon">
                        <i class="bi bi-gear"></i>
                    </div>
                    <div>
                        <p class="admin-action-title">Settings</p>
                        <p class="admin-action-desc">Manage store settings</p>
                    </div>
                    <i class="bi bi-chevron-right ms-auto"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Categories Summary -->
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5 class="mb-0">Categories Overview</h5>
            </div>
            <div class="admin-card-body">
                <div class="admin-categories-grid">
                    @forelse($categories as $category)
                        <div class="admin-category-item">
                            <div class="admin-category-icon" style="background: linear-gradient(135deg, rgba(232,82,26,0.1) 0%, rgba(232,82,26,0.05) 100%);">
                                <i class="bi bi-tag" style="color: #E8521A;"></i>
                            </div>
                            <p class="admin-category-name">{{ $category->name }}</p>
                            <p class="admin-category-count">{{ $category->products_count }} {{ Str::plural('product', $category->products_count) }}</p>
                        </div>
                    @empty
                        <p class="text-muted text-center" style="grid-column: 1 / -1;">No categories found</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Dashboard Page Header */
.admin-page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2rem;
}

.admin-page-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 0.25rem;
    letter-spacing: 1px;
}

.admin-page-subtitle {
    color: var(--gray-500);
    font-size: 0.95rem;
}

.admin-page-actions {
    display: flex;
    gap: 0.75rem;
}

/* Stats Grid */
.admin-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.admin-stat-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 0.75rem;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.admin-stat-card:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.admin-stat-content {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.admin-stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.8rem;
    flex-shrink: 0;
}

.admin-stat-label {
    font-size: 0.85rem;
    color: var(--gray-500);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.25rem;
}

.admin-stat-value {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--ink);
}

.admin-stat-change {
    font-size: 0.85rem;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border);
    margin-bottom: 0;
}

.admin-stat-change.positive {
    color: #10b981;
}

.admin-stat-change.negative {
    color: #ef4444;
}

.admin-stat-change i {
    margin-right: 0.25rem;
}

/* Admin Card */
.admin-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 0.75rem;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.admin-card-header {
    padding: 1.5rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.admin-card-header h5 {
    font-weight: 600;
    color: var(--ink);
}

.admin-card-body {
    padding: 1.5rem;
}

.btn-link {
    color: var(--accent);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-link:hover {
    color: #d96b1a;
}

/* Table */
.admin-table {
    margin-bottom: 0;
}

.admin-table thead {
    background: var(--gray-50);
}

.admin-table thead th {
    color: var(--gray-600);
    font-weight: 600;
    border: none;
    padding: 1rem;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.admin-table tbody td {
    padding: 1rem;
    border-color: var(--gray-200);
    vertical-align: middle;
}

.admin-table tbody tr:hover {
    background: var(--gray-50);
}

/* Quick Actions */
.admin-action-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border-radius: 0.5rem;
    color: var(--ink);
    transition: all 0.3s ease;
    margin-bottom: 0.5rem;
}

.admin-action-item:hover {
    background: var(--light-sage);
}

.admin-action-icon {
    width: 48px;
    height: 48px;
    border-radius: 0.5rem;
    background: var(--light-sage);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--sage);
    flex-shrink: 0;
}

.admin-action-item:hover .admin-action-icon {
    color: white;
    background: linear-gradient(135deg, var(--accent) 0%, #d96b1a 100%);
}

.admin-action-title {
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.admin-action-desc {
    font-size: 0.85rem;
    color: var(--gray-500);
    margin-bottom: 0;
}

/* Categories Grid */
.admin-categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1.5rem;
}

.admin-category-item {
    text-align: center;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border: 1px solid var(--border);
    transition: all 0.3s ease;
}

.admin-category-item:hover {
    border-color: var(--accent);
    box-shadow: 0 4px 12px rgba(232, 82, 26, 0.15);
}

.admin-category-icon {
    width: 70px;
    height: 70px;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 2rem;
}

.admin-category-name {
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 0.5rem;
}

.admin-category-count {
    font-size: 0.85rem;
    color: var(--gray-500);
    margin-bottom: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .admin-page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .admin-page-title {
        font-size: 1.5rem;
    }

    .admin-stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }

    .admin-categories-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>

@endsection
