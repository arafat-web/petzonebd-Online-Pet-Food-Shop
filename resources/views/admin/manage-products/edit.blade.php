@extends('admin.master')
@php
    $page = 'manage-products'
@endphp
@section('title')
    Edit Product
@endsection

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Edit Product</h1>
        <p class="admin-page-subtitle">Update product information and settings</p>
    </div>
    <div class="admin-page-actions">
        <a href="{{ route('manage.products') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
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

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        <strong>Validation Error!</strong> Please check the form below.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5 class="mb-2 mt-3">Product Information</h5>
            </div>
            <div class="admin-card-body">
                <form action="{{route('update.product')}}" method="post" enctype="multipart/form-data" class="admin-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="product-form-sections">
                        <!-- Basic Info Section -->
                        <div class="form-section-card">
                            <div class="form-section-header">
                                <i class="bi bi-info-circle"></i>
                                <h6>Basic Information</h6>
                            </div>
                            <div class="form-section-body">
                                <div class="form-fields-grid">
                                    <!-- Product Name -->
                                    <div class="form-group">
                                        <label for="name" class="form-label">
                                            <i class="bi bi-box2"></i> Product Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', $product->name) }}"
                                               placeholder="e.g., Premium Dog Food"
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Price -->
                                    <div class="form-group">
                                        <label for="price" class="form-label">
                                            <i class="bi bi-currency-dollar"></i> Price (৳)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" 
                                               class="form-control @error('price') is-invalid @enderror" 
                                               id="price" 
                                               name="price" 
                                               value="{{ old('price', $product->price) }}"
                                               placeholder="0.00"
                                               step="0.01"
                                               required>
                                        @error('price')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Brand -->
                                    <div class="form-group">
                                        <label for="brand" class="form-label">
                                            <i class="bi bi-tag"></i> Brand
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('brand') is-invalid @enderror" 
                                               id="brand" 
                                               name="brand" 
                                               value="{{ old('brand', $product->brand) }}"
                                               placeholder="e.g., Royal Canin"
                                               required>
                                        @error('brand')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Category -->
                                    <div class="form-group">
                                        <label for="category" class="form-label">
                                            <i class="bi bi-tags"></i> Category
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select @error('category') is-invalid @enderror" 
                                                id="category" 
                                                name="category" 
                                                required>
                                            <option value="" disabled>Choose a category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{ old('category', $product->cat_id) == $category->id ? 'selected' : '' }}>
                                                    {{$category->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing & Discount Section -->
                        <div class="form-section-card">
                            <div class="form-section-header">
                                <i class="bi bi-percent"></i>
                                <h6>Pricing & Discount</h6>
                            </div>
                            <div class="form-section-body">
                                <div class="form-fields-grid">
                                    <!-- Discount Price -->
                                    <div class="form-group">
                                        <label for="discount_price" class="form-label">
                                            <i class="bi bi-tag-fill"></i> Discount Price (৳)
                                        </label>
                                        <input type="number" 
                                               class="form-control @error('discount_price') is-invalid @enderror" 
                                               id="discount_price" 
                                               name="discount_price" 
                                               value="{{ old('discount_price', $product->discount_price) }}"
                                               placeholder="Leave empty if no discount"
                                               step="0.01"
                                               min="0">
                                        <small class="form-text text-muted d-block mt-2">Enter the discounted price. Leave empty for no discount.</small>
                                        @error('discount_price')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Discount Percentage (calculated) -->
                                    <div class="form-group">
                                        <label for="discount_percent" class="form-label">
                                            <i class="bi bi-percent"></i> Discount %
                                        </label>
                                        <input type="number" 
                                               class="form-control" 
                                               id="discount_percent" 
                                               name="discount_percent" 
                                               value="{{ old('discount_percent') }}"
                                               placeholder="Auto-calculated"
                                               readonly
                                               step="0.01">
                                        <small class="form-text text-muted d-block mt-2">Automatically calculated from discount price.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="form-section-card">
                            <div class="form-section-header">
                                <i class="bi bi-chat-left-text"></i>
                                <h6>Product Description</h6>
                            </div>
                            <div class="form-section-body">
                                <div class="form-group">
                                    <label for="description" class="form-label">
                                        Description
                                    </label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="6"
                                              placeholder="Describe your product in detail...">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Image Section -->
                        <div class="form-section-card">
                            <div class="form-section-header">
                                <i class="bi bi-image"></i>
                                <h6>Product Image</h6>
                            </div>
                            <div class="form-section-body">
                                <div class="form-group">
                                    <label for="image" class="form-label">
                                        Select Image
                                    </label>
                                    <div class="image-upload-wrapper">
                                        <input type="file" 
                                               class="form-control @error('image') is-invalid @enderror" 
                                               id="image" 
                                               name="image"
                                               accept="image/*"
                                               onchange="previewImage(event)">
                                        <small class="form-text text-muted d-block mt-2">Leave empty to keep current image</small>
                                        @error('image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    @if($product->image)
                                        <div style="margin-top: 1.5rem;">
                                            <p class="form-text text-muted mb-2">Current Image:</p>
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="max-width: 250px; max-height: 250px; border-radius: 0.5rem; border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                        </div>
                                    @endif

                                    <div id="imagePreview" style="margin-top: 1.5rem; display: none;">
                                        <p class="form-text text-muted mb-2">New Preview:</p>
                                        <img id="previewImg" src="" alt="Preview" style="max-width: 250px; max-height: 250px; border-radius: 0.5rem; border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions-card">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Update Product
                        </button>
                        <a href="{{ route('manage.products') }}" class="btn btn-outline-danger ms-auto">
                            <i class="bi bi-x-lg"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.admin-form {
    margin: 0;
}

.product-form-sections {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-section-card {
    background: #FEFCF9;
    border: 1px solid var(--border);
    border-radius: 0.75rem;
    overflow: hidden;
    transition: all 0.3s ease;
}

.form-section-card:hover {
    border-color: var(--accent);
    box-shadow: 0 2px 12px rgba(232, 82, 26, 0.08);
}

.form-section-header {
    padding: 1.25rem 1.5rem;
    background: linear-gradient(135deg, rgba(232, 82, 26, 0.05) 0%, rgba(74, 103, 65, 0.05) 100%);
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.form-section-header i {
    font-size: 1.2rem;
    color: var(--accent);
}

.form-section-header h6 {
    margin: 0;
    font-weight: 600;
    color: var(--ink);
    font-size: 0.95rem;
}

.form-section-body {
    padding: 1.5rem;
}

.form-fields-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.form-group {
    margin-bottom: 0;
}

.form-label {
    font-weight: 600;
    font-size: 0.95rem;
    color: var(--ink);
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-control,
.form-select {
    border: 1px solid var(--border);
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background-color: white;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 0.2rem rgba(232, 82, 26, 0.1);
    background-color: white;
}

.form-control.is-invalid,
.form-select.is-invalid {
    border-color: #dc3545;
}

.form-control.is-invalid:focus,
.form-select.is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.1);
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.85rem;
    margin-top: 0.25rem;
}

.text-danger {
    color: #dc3545;
}

textarea.form-control {
    font-family: inherit;
    resize: vertical;
    min-height: 150px;
}

.image-upload-wrapper {
    position: relative;
}

.form-text {
    font-size: 0.85rem;
    color: var(--gray-500);
}

.form-actions-card {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
    padding: 1.5rem;
    background: #FEFCF9;
    border: 1px solid var(--border);
    border-radius: 0.75rem;
    flex-wrap: wrap;
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

.btn-outline-secondary {
    color: var(--gray-600);
    border-color: var(--border);
    background-color: white;
}

.btn-outline-secondary:hover {
    background-color: var(--gray-100);
    border-color: var(--gray-400);
    color: var(--ink);
}

.btn-outline-danger {
    color: #dc3545;
    border-color: #dc3545;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
}

/* Alert Styles */
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

/* Responsive */
@media (max-width: 1024px) {
    .admin-page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
}

@media (max-width: 768px) {
    .admin-page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .form-fields-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .form-actions-card {
        flex-direction: column;
    }

    .form-actions-card .ms-auto {
        margin-left: 0 !important;
    }

    .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

// Calculate discount percentage when price or discount price changes
document.addEventListener('DOMContentLoaded', function() {
    const priceInput = document.getElementById('price');
    const discountPriceInput = document.getElementById('discount_price');
    const discountPercentInput = document.getElementById('discount_percent');

    function calculateDiscount() {
        const price = parseFloat(priceInput.value) || 0;
        const discountPrice = parseFloat(discountPriceInput.value) || 0;

        if (price > 0 && discountPrice > 0 && discountPrice < price) {
            const discountPercent = ((price - discountPrice) / price * 100).toFixed(2);
            discountPercentInput.value = discountPercent;
        } else {
            discountPercentInput.value = '';
        }
    }

    priceInput.addEventListener('change', calculateDiscount);
    priceInput.addEventListener('input', calculateDiscount);
    discountPriceInput.addEventListener('change', calculateDiscount);
    discountPriceInput.addEventListener('input', calculateDiscount);

    // Calculate on page load if values exist
    calculateDiscount();
});
</script>
@endsection
