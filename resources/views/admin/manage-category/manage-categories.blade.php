@extends('admin.master')
@php
    $page = 'manage-categories'
@endphp
@section('title')
    Manage Categories
@endsection
@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Manage Categories</h1>
        <p class="admin-page-subtitle">Create, edit, and manage product categories</p>
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
    <div class="col-lg-5">
        <div class="admin-card">
            <div class="admin-card-header">
                <div>
                    @if(isset($edit) && $edit === 'true')
                        <h5 class="admin-card-title">Update Category</h5>
                        <p class="admin-card-subtitle">Edit existing category details</p>
                    @else
                        <h5 class="admin-card-title">Add New Category</h5>
                        <p class="admin-card-subtitle">Create a new product category</p>
                    @endif
                </div>
            </div>
            <div class="admin-card-body">
                @if(isset($edit) && $edit === 'true')
                    <form action="{{route('update.category')}}" method="post" enctype="multipart/form-data" class="category-form">
                        @csrf
                        <input type="hidden" value="{{$category->id}}" name="id">
                        
                        <div class="form-group mb-4">
                            <label for="cat_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="cat_name" placeholder="Enter category name"
                                   value="{{$category->name}}" name="cat_name" required>
                            @error('cat_name')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="cat_slug" class="form-label">Category Slug</label>
                            <input type="text" class="form-control" id="cat_slug" placeholder="Enter slug name"
                                   value="{{$category->slug}}" name="cat_slug" required>
                            <small class="text-muted d-block mt-1">* Slug should be unique</small>
                        </div>

                        <div class="form-group mb-4">
                            <label for="cat_img" class="form-label">Category Image</label>
                            <input type="file" class="form-control" id="cat_img" name="cat_img" accept="image/*" onchange="previewImage(event)">
                            <small class="text-muted d-block mt-1">* Leave empty to keep current image</small>
                            <div class="mt-3">
                                <img id="imagePreview" src="{{asset($category->cat_image)}}" alt="Category" class="category-preview-image">
                            </div>
                            <input type="hidden" value="{{$category->cat_image}}" name="img_path">
                        </div>

                        <div class="form-actions d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="bi bi-check-lg me-1"></i> Update Category
                            </button>
                            <a href="{{ route('manage.categories') }}" class="btn btn-outline-secondary flex-grow-1">
                                <i class="bi bi-x-lg me-1"></i> Cancel
                            </a>
                        </div>
                    </form>
                @else
                    <form action="{{route('add.category')}}" method="post" enctype="multipart/form-data" class="category-form">
                        @csrf
                        
                        <div class="form-group mb-4">
                            <label for="cat_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="cat_name" placeholder="Enter category name"
                                   value="{{ old('cat_name') }}" name="cat_name" required>
                            @error('cat_name')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="cat_slug" class="form-label">Category Slug</label>
                            <input type="text" class="form-control" id="cat_slug" placeholder="Enter slug name"
                                   value="{{ old('cat_slug') }}" name="cat_slug" required>
                            <small class="text-muted d-block mt-1">* Slug should be unique</small>
                        </div>

                        <div class="form-group mb-4">
                            <label for="cat_img" class="form-label">Category Image</label>
                            <input type="file" class="form-control" id="cat_img" name="cat_img" accept="image/*" required onchange="previewImage(event)">
                            <div class="mt-3">
                                <img id="imagePreview" class="category-preview-image" style="display: none;">
                            </div>
                        </div>

                        <div class="form-actions d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="bi bi-plus-lg me-1"></i> Add Category
                            </button>
                            <button type="reset" class="btn btn-outline-secondary flex-grow-1">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="admin-card">
            <div class="admin-card-header">
                <div>
                    <h5 class="admin-card-title">All Categories</h5>
                    <p class="admin-card-subtitle">Complete list of all categories</p>
                </div>
                <div class="admin-card-stats">
                    <span class="stat-badge">{{ count($categories) }} Total</span>
                </div>
            </div>
            <div class="admin-card-body">
                <div class="table-responsive">
                    <table id="categoriesTable" class="table table-hover table-striped" style="width:100%">
                        <thead class="table-header">
                            <tr>
                                <th>Category Name</th>
                                <th>Category Image</th>
                                <th style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $cat)
                                <tr>
                                    <td>
                                        <strong class="text-dark">{{ $cat->name }}</strong>
                                    </td>
                                    <td>
                                        <img src="{{asset($cat->cat_image)}}" alt="{{$cat->name}}" class="category-table-image">
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a class="btn btn-sm btn-primary" href="{{route('edit.category', ['id'=>$cat->id])}}" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="{{route('delete.category', ['id'=>$cat->id])}}"
                                               onclick="return confirm('Are you sure you want to delete this category?')" title="Delete">
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

.form-label {
    color: var(--ink);
    font-weight: 600;
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
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

.category-preview-image {
    max-width: 100%;
    max-height: 150px;
    border-radius: 0.5rem;
    border: 1px solid var(--border);
    object-fit: cover;
}

.category-table-image {
    width: 45px;
    height: 45px;
    border-radius: 0.4rem;
    border: 1px solid var(--border);
    object-fit: cover;
    transition: transform 0.2s ease;
}

.category-table-image:hover {
    transform: scale(1.1);
}

.form-actions {
    display: flex;
    gap: 0.75rem;
    margin-top: 2rem;
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

.btn-outline-secondary {
    color: var(--gray-600);
    border: 1px solid var(--border);
    background: white;
}

.btn-outline-secondary:hover {
    background-color: var(--gray-500);
    color: white;
    border-color: var(--gray-500);
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

.table-header {
    background: linear-gradient(135deg, rgba(232, 82, 26, 0.08) 0%, rgba(74, 103, 65, 0.08) 100%);
    border-bottom: 2px solid var(--accent);
}

.table-header th {
    font-weight: 700;
    color: var(--ink);
    padding: 1rem;
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

.text-muted {
    color: var(--gray-500) !important;
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

    .row {
        flex-wrap: wrap;
    }

    .col-lg-5,
    .col-lg-7 {
        flex: 0 0 100%;
        max-width: 100%;
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

    .form-actions {
        flex-direction: column;
    }

    .btn {
        width: 100%;
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
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

$(document).ready(function() {
    $('#categoriesTable').DataTable({
        responsive: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        paging: true,
        info: true,
        pageLength: 10,
        language: {
            search: "Search Categories:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ categories",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            },
            emptyTable: "No categories available"
        },
        order: [[0, 'asc']],
        columnDefs: [
            { targets: 2, orderable: false, searchable: false }
        ]
    });
});
</script>
@endsection
