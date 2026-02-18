@extends('admin.master')
@php
    $page = 'manage-products'
@endphp
@section('title')
    Manage Products
@endsection

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Manage Products</h1>
        <p class="admin-page-subtitle">View, edit, and manage all your products</p>
    </div>
    <div class="admin-page-actions">
        <a href="{{ route('add.product') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add New Product
        </a>
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
                    <h5 class="admin-card-title">All Products</h5>
                    <p class="admin-card-subtitle">Complete list of all products in your system</p>
                </div>
                <div class="admin-card-stats">
                    <span class="stat-badge">{{ count($products) }} Total</span>
                </div>
            </div>
            <div class="admin-card-body">
                <div class="table-responsive">
                    <table id="productsTable" class="table table-hover table-striped" style="width:100%">
                        <thead class="table-header">
                            <tr>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Discount Price</th>
                                <th>Image</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <div class="product-info">
                                            <strong>{{ $product->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $product->cat_name }}</span>
                                    </td>
                                    <td>{{ $product->brand }}</td>
                                    <td>
                                        <strong class="text-primary">৳ {{ number_format($product->price) }}</strong>
                                    </td>
                                    <td>
                                        @if($product->discount_price)
                                            <span class="badge bg-success">৳ {{ number_format($product->discount_price) }}</span>
                                            <br>
                                            <small class="text-success fw-bold">
                                                -{{ round(((($product->price - $product->discount_price) / $product->price) * 100), 1) }}%
                                            </small>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-thumbnail">
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('edit.product', $product->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="{{ route('delete.product', $product->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

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

.btn {
    border-radius: 0.5rem;
    padding: 0.625rem 1.5rem;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
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
}

.btn-sm {
    padding: 0.35rem 0.65rem;
    font-size: 0.85rem;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

.btn-primary:not(.btn-sm) {
    background-color: var(--accent);
    border-color: var(--accent);
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

.product-info {
    padding: 0.5rem 0;
}

.product-info strong {
    display: block;
    color: var(--ink);
    margin-bottom: 0.25rem;
}

.product-thumbnail {
    width: 50px;
    height: 50px;
    border-radius: 0.5rem;
    border: 1px solid var(--border);
    object-fit: cover;
    transition: transform 0.2s ease;
}

.product-thumbnail:hover {
    transform: scale(1.05);
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
}

.badge {
    padding: 0.4rem 0.8rem;
    border-radius: 0.35rem;
    font-size: 0.85rem;
    font-weight: 500;
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

/* DataTables Customization */
.dataTables_wrapper {
    padding: 0;
}

.dataTables_length,
.dataTables_filter {
    margin-bottom: 1rem;
}

.dataTables_filter input {
    border: 1px solid var(--border) !important;
    border-radius: 0.5rem !important;
    padding: 0.5rem 1rem !important;
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

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background-color: rgba(232, 82, 26, 0.05);
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

.fw-bold {
    font-weight: 700;
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

    .admin-card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem;
    }

    .admin-card-title {
        font-size: 1.25rem;
    }

    .admin-card-body {
        padding: 1rem;
    }

    .table {
        font-size: 0.9rem;
    }

    .product-info strong {
        font-size: 0.95rem;
    }

    .action-buttons {
        flex-wrap: wrap;
    }

    .btn-sm {
        padding: 0.3rem 0.6rem;
        font-size: 0.75rem;
    }

    .stat-badge {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }
}
</style>

<script>
$(document).ready(function() {
    $('#productsTable').DataTable({
        responsive: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        paging: true,
        info: true,
        pageLength: 10,
        language: {
            search: "Search Products:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ products",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            },
            emptyTable: "No products available"
        },
        order: [[0, 'asc']],
        columnDefs: [
            { targets: 6, orderable: false, searchable: false }
        ]
    });
});
</script>
@endsection
