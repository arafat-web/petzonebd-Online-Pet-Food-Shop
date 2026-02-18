@extends('admin.master')
@php
    $page = 'manage-users'
@endphp
@section('title')
    User Details - {{ $user->name }}
@endsection

@section('content')
<div class="admin-page-header">
    <div>
        <a href="{{ route('manage.users') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="admin-page-title">User Profile</h1>
        <p class="admin-page-subtitle">View user information and order history</p>
    </div>
</div>

<div class="row">
    <!-- User Information Card -->
    <div class="col-lg-4 mb-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <div>
                    <h5 class="admin-card-title">Account Details</h5>
                </div>
            </div>
            <div class="admin-card-body">
                <div class="user-profile-section">
                    <div class="profile-avatar" style="background: linear-gradient(135deg, #E8521A 0%, #4A6741 100%);">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h4 class="profile-name">{{ $user->name }}</h4>
                    <p class="profile-email">{{ $user->email }}</p>
                </div>

                <div class="user-details-list">
                    <div class="detail-item">
                        <label>Role</label>
                        <span class="badge @if($user->role === 'admin') bg-danger @else bg-info @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    <div class="detail-item">
                        <label>Account Status</label>
                        <span class="status-indicator active">
                            <i class="bi bi-circle-fill"></i>
                            Active
                        </span>
                    </div>
                    <div class="detail-item">
                        <label>Member Since</label>
                        <span class="detail-value">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="detail-item">
                        <label>Last Updated</label>
                        <span class="detail-value">{{ $user->updated_at->format('M d, Y \a\t H:i') }}</span>
                    </div>
                </div>

                <div class="profile-actions">
                    @if($user->id !== auth()->id())
                        <a href="{{ route('delete.user', $user->id) }}" class="btn btn-danger w-100" 
                           onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                            <i class="bi bi-trash me-1"></i> Delete User
                        </a>
                    @else
                        <button class="btn btn-secondary w-100" disabled>
                            <i class="bi bi-shield-lock me-1"></i> Your Own Account
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- User Orders -->
    <div class="col-lg-8 mb-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <div>
                    <h5 class="admin-card-title">Order History</h5>
                    <p class="admin-card-subtitle">All orders placed by this user</p>
                </div>
                <div class="admin-card-stats">
                    <span class="stat-badge">{{ count($orders) }} Orders</span>
                </div>
            </div>
            <div class="admin-card-body">
                @if(count($orders) > 0)
                    <div class="orders-list">
                        @foreach($orders as $order)
                            <div class="order-item">
                                <div class="order-header">
                                    <div>
                                        <h6 class="order-number">{{ $order->order_number }}</h6>
                                        <p class="order-date">{{ $order->created_at->format('M d, Y \a\t H:i') }}</p>
                                    </div>
                                    <div class="order-status">
                                        <span class="badge status-badge status-{{ $order->status }}">
                                            <i class="bi bi-circle-fill"></i>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="order-details-row">
                                    <div class="detail-col">
                                        <span class="detail-label">Total Amount</span>
                                        <span class="amount">৳ {{ number_format($order->total, 2) }}</span>
                                    </div>
                                    <div class="detail-col">
                                        <span class="detail-label">Payment Method</span>
                                        <span class="method">{{ $order->payment_method ?? 'N/A' }}</span>
                                    </div>
                                    <div class="detail-col">
                                        <span class="detail-label">Shipping City</span>
                                        <span class="city">{{ $order->shipping_city }}</span>
                                    </div>
                                    <div class="detail-col action-col">
                                        <a href="{{ route('view.order', $order->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye me-1"></i> View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-bag-x"></i>
                        <p>No orders found for this user</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --cream: #FAF7F2;
    --ink: #2E2E2C;
    --accent: #E8521A;
    --sage: #4A6741;
    --sand: #C4B5A0;
    --border: #e9ecef;
    --gray-500: #6c757d;
    --gray-600: #495057;
}

.admin-page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2rem;
}

.admin-page-header > div {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.btn-back {
    background: white;
    border: 1px solid var(--border);
    width: 40px;
    height: 40px;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--ink);
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-back:hover {
    background: var(--accent);
    color: white;
    border-color: var(--accent);
}

.admin-page-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 0;
    letter-spacing: 1px;
}

.admin-page-subtitle {
    color: var(--gray-500);
    font-size: 0.95rem;
    margin: 0;
}

.admin-card {
    background: white;
    border-radius: 0.75rem;
    border: 1px solid var(--border);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    margin-bottom: 2rem;
    transition: all 0.3s ease;
}

.admin-card:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.admin-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.5rem;
    background: linear-gradient(135deg, rgba(232, 82, 26, 0.08) 0%, rgba(74, 103, 65, 0.08) 100%);
    border-bottom: 2px solid var(--accent);
}

.admin-card-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--ink);
    margin: 0;
    letter-spacing: 0.5px;
}

.admin-card-subtitle {
    color: var(--gray-500);
    font-size: 0.9rem;
    margin: 0.35rem 0 0 0;
}

.admin-card-stats {
    display: flex;
    gap: 0.75rem;
}

.stat-badge {
    background: var(--accent);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.35rem;
    font-size: 0.85rem;
    font-weight: 600;
}

.admin-card-body {
    padding: 1.5rem;
}

/* User Profile Section */
.user-profile-section {
    text-align: center;
    padding: 1.5rem 0;
    border-bottom: 1px solid var(--border);
    margin-bottom: 1.5rem;
}

.profile-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 2rem;
    margin: 0 auto 1rem;
}

.profile-name {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--ink);
    margin: 0 0 0.25rem 0;
}

.profile-email {
    color: var(--gray-500);
    margin: 0;
    font-size: 0.9rem;
}

/* User Details List */
.user-details-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
}

.detail-item label {
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--gray-500);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.detail-value {
    font-size: 0.95rem;
    color: var(--ink);
    font-weight: 500;
}

.badge {
    display: inline-block;
    padding: 0.4rem 0.8rem;
    border-radius: 0.35rem;
    font-size: 0.85rem;
    font-weight: 500;
}

.status-indicator {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.4rem 0.8rem;
    border-radius: 2rem;
    font-size: 0.85rem;
    font-weight: 500;
}

.status-indicator.active {
    background-color: #d1fae5;
    color: #065f46;
}

.status-indicator i {
    font-size: 0.6rem;
}

/* Profile Actions */
.profile-actions {
    display: flex;
    gap: 0.5rem;
}

.btn {
    padding: 0.625rem 1.5rem;
    font-weight: 600;
    font-size: 0.95rem;
    border-radius: 0.5rem;
    border: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-decoration: none;
    cursor: pointer;
}

.btn-primary {
    background-color: var(--accent);
    color: white;
}

.btn-primary:hover {
    background-color: #d96b1a;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(232, 82, 26, 0.3);
}

.btn-danger {
    background-color: #dc3545;
    color: white;
}

.btn-danger:hover {
    background-color: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn-secondary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.btn-sm {
    padding: 0.35rem 0.65rem;
    font-size: 0.85rem;
}

.w-100 {
    width: 100%;
}

/* Orders List */
.orders-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.order-item {
    border: 1px solid var(--border);
    border-radius: 0.5rem;
    padding: 1rem;
    transition: all 0.2s ease;
}

.order-item:hover {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    border-color: var(--accent);
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border);
}

.order-number {
    font-weight: 700;
    color: var(--ink);
    margin: 0;
    font-size: 0.95rem;
}

.order-date {
    font-size: 0.85rem;
    color: var(--gray-500);
    margin: 0.25rem 0 0 0;
}

.order-status {
    flex-shrink: 0;
}

.status-badge {
    padding: 0.5rem 0.8rem;
    border-radius: 2rem;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
}

.status-pending {
    background-color: #fef3c7;
    color: #92400e;
}

.status-processing {
    background-color: #e0e7ff;
    color: #3730a3;
}

.status-shipped {
    background-color: #bfdbfe;
    color: #1e40af;
}

.status-delivered {
    background-color: #d1fae5;
    color: #065f46;
}

.status-cancelled {
    background-color: #fee2e2;
    color: #991b1b;
}

.status-badge i {
    font-size: 0.6rem;
}

.order-details-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
    align-items: center;
}

.detail-col {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
}

.detail-label {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--gray-500);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.amount {
    font-weight: 700;
    color: #10b981;
    font-size: 0.95rem;
}

.method {
    font-size: 0.9rem;
    color: var(--ink);
    font-weight: 500;
}

.city {
    font-size: 0.9rem;
    color: var(--ink);
    font-weight: 500;
}

.action-col {
    display: flex;
    align-items: flex-end;
    justify-content: center;
}

.empty-state {
    text-align: center;
    padding: 2rem;
    color: var(--gray-500);
}

.empty-state i {
    font-size: 2.5rem;
    opacity: 0.5;
    margin-bottom: 0.75rem;
}

.empty-state p {
    margin: 0;
    font-size: 0.95rem;
}

/* Responsive */
@media (max-width: 768px) {
    .admin-page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .admin-page-title {
        font-size: 1.5rem;
    }

    .order-details-row {
        grid-template-columns: 1fr 1fr;
    }

    .action-col {
        grid-column: 1 / -1;
    }

    .action-col .btn {
        width: 100%;
    }
}
</style>
@endsection
