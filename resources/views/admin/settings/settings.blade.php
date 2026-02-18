@extends('admin.master')
@php
    $page = 'settings'
@endphp
@section('title')
    Settings
@endsection

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Admin Settings</h1>
        <p class="admin-page-subtitle">Manage your store configuration and preferences</p>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Validation Errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>
</div>

<form method="POST" action="{{ route('settings.update') }}" id="settingsForm">
    @csrf
    @method('PUT')

    <!-- General Settings -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="bi bi-shop"></i> General Information
                    </h5>
                </div>
                <div class="admin-card-body">
                    <div class="mb-3">
                        <label for="site_name" class="form-label">Store Name</label>
                        <input type="text" class="form-control @error('site_name') is-invalid @enderror" 
                               id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name']) }}" required>
                        @error('site_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="site_title" class="form-label">Store Title (Browser Tab)</label>
                        <input type="text" class="form-control @error('site_title') is-invalid @enderror" 
                               id="site_title" name="site_title" value="{{ old('site_title', $settings['site_title']) }}" required>
                        @error('site_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="site_description" class="form-label">Store Description</label>
                        <textarea class="form-control @error('site_description') is-invalid @enderror" 
                                  id="site_description" name="site_description" rows="3">{{ old('site_description', $settings['site_description']) }}</textarea>
                        @error('site_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="currency" class="form-label">Currency</label>
                        <select class="form-control @error('currency') is-invalid @enderror" 
                                id="currency" name="currency" required>
                            <option value="BDT" @selected(old('currency', $settings['currency']) === 'BDT')>Bangladeshi Taka (৳)</option>
                            <option value="USD" @selected(old('currency', $settings['currency']) === 'USD')>US Dollar ($)</option>
                            <option value="EUR" @selected(old('currency', $settings['currency']) === 'EUR')>Euro (€)</option>
                            <option value="GBP" @selected(old('currency', $settings['currency']) === 'GBP')>British Pound (£)</option>
                        </select>
                        @error('currency') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="col-lg-6">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="bi bi-telephone"></i> Contact Information
                    </h5>
                </div>
                <div class="admin-card-body">
                    <div class="mb-3">
                        <label for="contact_email" class="form-label">Contact Email</label>
                        <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                               id="contact_email" name="contact_email" value="{{ old('contact_email', $settings['contact_email']) }}" required>
                        @error('contact_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contact_phone" class="form-label">Contact Phone</label>
                        <input type="tel" class="form-control @error('contact_phone') is-invalid @enderror" 
                               id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone']) }}" required>
                        @error('contact_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="store_address" class="form-label">Store Address</label>
                        <input type="text" class="form-control @error('store_address') is-invalid @enderror" 
                               id="store_address" name="store_address" value="{{ old('store_address', $settings['store_address']) }}" required>
                        @error('store_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="store_city" class="form-label">City</label>
                            <input type="text" class="form-control @error('store_city') is-invalid @enderror" 
                                   id="store_city" name="store_city" value="{{ old('store_city', $settings['store_city']) }}" required>
                            @error('store_city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="store_zip" class="form-label">Zip Code</label>
                            <input type="text" class="form-control @error('store_zip') is-invalid @enderror" 
                                   id="store_zip" name="store_zip" value="{{ old('store_zip', $settings['store_zip']) }}" required>
                            @error('store_zip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Policies & Terms -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="bi bi-shield-check"></i> Return & Shipping Policy
                    </h5>
                </div>
                <div class="admin-card-body">
                    <div class="mb-3">
                        <label for="return_policy" class="form-label">Return Policy</label>
                        <textarea class="form-control @error('return_policy') is-invalid @enderror" 
                                  id="return_policy" name="return_policy" rows="4">{{ old('return_policy', $settings['return_policy']) }}</textarea>
                        <small class="form-text text-muted">Explain your return process and timeframe</small>
                        @error('return_policy') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="bi bi-truck"></i> Shipping Policy
                    </h5>
                </div>
                <div class="admin-card-body">
                    <div class="mb-3">
                        <label for="shipping_policy" class="form-label">Shipping Policy</label>
                        <textarea class="form-control @error('shipping_policy') is-invalid @enderror" 
                                  id="shipping_policy" name="shipping_policy" rows="4">{{ old('shipping_policy', $settings['shipping_policy']) }}</textarea>
                        <small class="form-text text-muted">Include shipping costs, delivery time, and conditions</small>
                        @error('shipping_policy') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment & SEO -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="bi bi-credit-card"></i> Payment Methods
                    </h5>
                </div>
                <div class="admin-card-body">
                    <div class="mb-3">
                        <label for="payment_methods" class="form-label">Available Payment Methods</label>
                        <textarea class="form-control @error('payment_methods') is-invalid @enderror" 
                                  id="payment_methods" name="payment_methods" rows="4">{{ old('payment_methods', $settings['payment_methods']) }}</textarea>
                        <small class="form-text text-muted">List all payment options separated by commas</small>
                        @error('payment_methods') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="bi bi-search"></i> SEO Settings
                    </h5>
                </div>
                <div class="admin-card-body">
                    <div class="mb-3">
                        <label for="seo_keywords" class="form-label">Meta Keywords</label>
                        <textarea class="form-control @error('seo_keywords') is-invalid @enderror" 
                                  id="seo_keywords" name="seo_keywords" rows="4">{{ old('seo_keywords', $settings['seo_keywords']) }}</textarea>
                        <small class="form-text text-muted">Comma-separated keywords for SEO</small>
                        @error('seo_keywords') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Settings -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="bi bi-sliders"></i> System Settings
                    </h5>
                </div>
                <div class="admin-card-body">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="maintenance_mode" 
                               name="maintenance_mode" value="1" @checked(old('maintenance_mode', $settings['maintenance_mode']))>
                        <label class="form-check-label" for="maintenance_mode">
                            <strong>Maintenance Mode</strong>
                            <small class="d-block text-muted">Enable to show maintenance message to visitors</small>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row">
        <div class="col-12">
            <div class="admin-card">
                <div class="admin-card-body" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Save Settings
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
.admin-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px 20px;
    background-color: #E8521A;
    color: white;
    margin: -20px -20px 20px -20px;
    border-radius: 8px 8px 0 0;
}

.admin-card-title {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.admin-card-title i {
    font-size: 18px;
}

.form-label {
    font-weight: 600;
    color: #2E2E2C;
    margin-bottom: 8px;
}

.form-control:focus {
    border-color: #E8521A;
    box-shadow: 0 0 0 0.2rem rgba(232, 82, 26, 0.25);
}

.form-check-label {
    margin-left: 8px;
    cursor: pointer;
    user-select: none;
}

.btn {
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    background-color: #E8521A;
    border-color: #E8521A;
}

.btn-primary:hover {
    background-color: #d1411a;
    border-color: #d1411a;
    transform: translateY(-2px);
}

.btn-secondary:hover {
    transform: translateY(-2px);
}

.btn-outline-secondary:hover {
    transform: translateY(-2px);
}
</style>
@endsection
