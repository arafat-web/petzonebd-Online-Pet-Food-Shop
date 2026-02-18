@extends('admin.master')
@php
    $page = 'manage-users'
@endphp
@section('title')
    Manage Users
@endsection

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Manage Users</h1>
        <p class="admin-page-subtitle">View and manage all user accounts</p>
    </div>
</div>

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session()->get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session()->get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <div>
                    <h5 class="admin-card-title">All Users</h5>
                    <p class="admin-card-subtitle">Complete list of all registered users</p>
                </div>
                <div class="admin-card-stats">
                    <span class="stat-badge">{{ count($users) }} Total</span>
                </div>
            </div>
            <div class="admin-card-body">
                <div class="filters-section mb-4">
                    <form action="{{ route('manage.users') }}" method="GET" class="filter-form">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
                            </div>
                            <div class="col-lg-3">
                                <select name="role" class="form-control">
                                    <option value="">All Roles</option>
                                    <option value="admin" @if(request('role') === 'admin') selected @endif>Admin</option>
                                    <option value="user" @if(request('role') === 'user') selected @endif>Customer</option>
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
                    <table class="table table-hover table-striped" style="width:100%">
                        <thead class="table-header">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Joined Date</th>
                                <th>Status</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>
                                        <div class="user-info">
                                            <div class="user-avatar" style="background: linear-gradient(135deg, #E8521A 0%, #4A6741 100%);">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <strong class="text-dark">{{ $user->name }}</strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </td>
                                    <td>
                                        <span class="badge @if($user->role === 'admin') bg-danger @else bg-info @endif">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $user->created_at->format('M d, Y') }}</small>
                                    </td>
                                    <td>
                                        <span class="status-indicator active">
                                            <i class="bi bi-circle-fill"></i>
                                            Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('view.user', $user->id) }}" class="btn btn-sm btn-primary" title="View Profile">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if($user->id !== auth()->id())
                                                <a href="{{ route('delete.user', $user->id) }}" class="btn btn-sm btn-danger" 
                                                   onclick="return confirm('Are you sure you want to delete this user?')" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            @else
                                                <button class="btn btn-sm btn-secondary" disabled title="Cannot delete your own account">
                                                    <i class="bi bi-shield-lock"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="bi bi-people" style="font-size: 2rem; color: var(--gray-500);"></i>
                                        <p class="text-muted mt-2">No users found</p>
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

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
    color: white;
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

.user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 0.9rem;
}

.badge {
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

.action-buttons {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
}

.action-buttons a,
.action-buttons button {
    text-decoration: none;
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background-color: rgba(232, 82, 26, 0.05);
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

.alert-danger {
    background-color: #fee2e2;
    color: #991b1b;
}

.text-muted {
    color: var(--gray-500) !important;
}

.text-dark {
    color: var(--ink) !important;
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

    .user-info {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>
@endsection
