@extends('admin.master')
@php
    $page = 'manage-orders'
@endphp
@section('title')
    Manage Orders
@endsection

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Manage Orders</h1>
        <p class="admin-page-subtitle">View, track, and manage all customer orders</p>
    </div>
</div>

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session()->get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <div>
                    <h5 class="admin-card-title">All Orders</h5>
                    <p class="admin-card-subtitle">Complete list of all customer orders</p>
                </div>
                <div class="admin-card-stats">
                    <span class="stat-badge">{{ count($orders) }} Total</span>
                </div>
            </div>
            <div class="admin-card-body">
                <div class="filters-section mb-4">
                    <form action="{{ route('manage.orders') }}" method="GET" class="filter-form">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <input type="text" name="search" class="form-control" placeholder="Search by order number, customer name, email, or phone..." value="{{ request('search') }}">
                            </div>
                            <div class="col-lg-3">
                                <select name="status" class="form-control">
                                    <option value="">All Status</option>
                                    <option value="pending" @if(request('status') === 'pending') selected @endif>Pending</option>
                                    <option value="processing" @if(request('status') === 'processing') selected @endif>Processing</option>
                                    <option value="shipped" @if(request('status') === 'shipped') selected @endif>Shipped</option>
                                    <option value="delivered" @if(request('status') === 'delivered') selected @endif>Delivered</option>
                                    <option value="cancelled" @if(request('status') === 'cancelled') selected @endif>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-funnel me-1"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table id="ordersTable" class="table table-hover table-striped" style="width:100%">
                        <thead class="table-header">
                            <tr>
                                <th>Order Number</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Date</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>
                                        <strong class="text-primary">{{ $order->order_number }}</strong>
                                    </td>
                                    <td>
                                        <div class="customer-info">
                                            <strong>{{ $order->customer_name }}</strong>
                                            @if($order->user)
                                                <br><small class="text-muted">{{ $order->user->name }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $order->customer_email }}</small>
                                    </td>
                                    <td>
                                        <strong class="text-success">৳ {{ number_format($order->total, 2) }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge status-badge status-{{ $order->status }}">
                                            <i class="bi bi-circle-fill me-1" style="font-size: 0.6rem;"></i>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $order->payment_method ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('view.order', $order->id) }}" class="btn btn-sm btn-primary" title="View Details">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-warning" title="Update Status" data-bs-toggle="modal" data-bs-target="#statusModal{{ $order->id }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <i class="bi bi-inbox" style="font-size: 2rem; color: var(--gray-500);"></i>
                                        <p class="text-muted mt-2">No orders found</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modals (Outside Table) -->
@foreach($orders as $order)
    <div class="modal fade" id="statusModal{{ $order->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Order Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('update.order.status', $order->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Current Status: <strong class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</strong></label>
                            <label class="form-label mt-3">New Status</label>
                            <select name="status" class="form-control" required>
                                <option value="pending" @if($order->status === 'pending') selected @endif>Pending</option>
                                <option value="processing" @if($order->status === 'processing') selected @endif>Processing</option>
                                <option value="shipped" @if($order->status === 'shipped') selected @endif>Shipped</option>
                                <option value="delivered" @if($order->status === 'delivered') selected @endif>Delivered</option>
                                <option value="cancelled" @if($order->status === 'cancelled') selected @endif>Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- jQuery -->

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

.filters-section {
    background: rgba(232, 82, 26, 0.03);
    padding: 1.5rem;
    border-radius: 0.5rem;
    border: 1px solid rgba(232, 82, 26, 0.1);
}

.form-control {
    border: 1px solid var(--border);
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    transition: all 0.2s ease;
}

.form-control:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(232, 82, 26, 0.1);
}

.btn {
    border-radius: 0.5rem;
    padding: 0.625rem 1.5rem;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    border: none;
}

.btn-primary {
    background-color: var(--accent);
    border-color: var(--accent);
    color: white;
}

.btn-primary:hover {
    background-color: #d96b1a;
    border-color: #d96b1a;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(232, 82, 26, 0.3);
    color: white;
}

.btn-sm {
    padding: 0.35rem 0.65rem;
    font-size: 0.85rem;
}

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #000;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
}

.table-header {
    background: linear-gradient(135deg, rgba(232, 82, 26, 0.08) 0%, rgba(74, 103, 65, 0.08) 100%);
    border-bottom: 2px solid var(--accent);
}

.table-header th {
    font-weight: 700;
    color: var(--ink);
    padding: 1rem;
}

.status-badge {
    padding: 0.5rem 0.8rem;
    border-radius: 2rem;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
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

.badge {
    padding: 0.4rem 0.8rem;
    border-radius: 0.35rem;
    font-size: 0.85rem;
    font-weight: 500;
}

.customer-info strong {
    display: block;
    color: var(--ink);
    margin-bottom: 0.25rem;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background-color: rgba(232, 82, 26, 0.05);
}

.table {
    margin-bottom: 0;
}

.table td, .table th {
    vertical-align: middle;
    padding: 0.75rem;
}

.table-header th {
    white-space: nowrap;
}

.alert {
    border-radius: 0.5rem;
    border: none;
    margin-bottom: 1.5rem;
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.alert-success {
    background-color: #d1fae5;
    color: #065f46;
}

.text-muted {
    color: var(--gray-500) !important;
}

.text-primary {
    color: var(--accent) !important;
}

.text-success {
    color: #10b981 !important;
}

/* Modal Styling */
.modal-content {
    border: none;
    border-radius: 0.75rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.modal-header {
    background: linear-gradient(135deg, rgba(232, 82, 26, 0.08) 0%, rgba(74, 103, 65, 0.08) 100%);
    border-bottom: 1px solid var(--border);
    border-top-left-radius: 0.75rem;
    border-top-right-radius: 0.75rem;
}

.modal-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--ink);
}

/* DataTables Customization */
.dataTables_wrapper {
    padding: 0;
}

.dataTables_length,
.dataTables_filter {
    margin-bottom: 1rem;
    display: none;
}

.dataTables_paginate .paginate_button {
    border-radius: 0.35rem;
    margin: 0 0.25rem;
}

.dataTables_paginate .paginate_button.current {
    background: var(--accent) !important;
    border: 1px solid var(--accent) !important;
    color: white !important;
}

.dataTables_info {
    margin-top: 1rem;
    color: var(--gray-600);
}

/* Responsive */
@media (max-width: 1024px) {
    .admin-page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .admin-card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
}

@media (max-width: 768px) {
    .admin-page-title {
        font-size: 1.5rem;
    }

    .admin-card-title {
        font-size: 1.25rem;
    }

    .admin-card-body,
    .admin-card-header {
        padding: 1rem;
    }

    .filters-section {
        padding: 1rem;
    }

    .row.g-3 {
        gap: 0.75rem !important;
    }

    .table {
        font-size: 0.9rem;
    }

    .action-buttons {
        flex-wrap: wrap;
    }

    .btn-sm {
        padding: 0.3rem 0.6rem;
        font-size: 0.75rem;
    }
}
</style>

<script>
// Bootstrap table with native scrolling and filtering via form above
// No external DataTables library dependencies
</script>
@endsection
