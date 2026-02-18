@extends('admin.master')
@php
    $page = 'sales'
@endphp
@section('title')
    Sales & Analytics
@endsection

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Sales & Analytics</h1>
        <p class="admin-page-subtitle">Track revenue, orders, and sales performance</p>
    </div>
</div>

<!-- Export Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-body">
                <div style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center;">
                    <span style="font-weight: 600; color: #2E2E2C; margin-right: 10px;">📥 Export Report:</span>
                    <a href="{{ route('sales.export.excel') }}" class="btn btn-success btn-sm" title="Export Analytics to Excel">
                        <i class="bi bi-file-earmark-spreadsheet"></i> Excel Analytics
                    </a>
                    <a href="{{ route('sales.export.pdf') }}" class="btn btn-danger btn-sm" title="Export Analytics to PDF">
                        <i class="bi bi-file-earmark-pdf"></i> PDF Report
                    </a>
                    <a href="{{ route('sales.export.orders') }}" class="btn btn-info btn-sm" title="Export Order History to Excel">
                        <i class="bi bi-download"></i> Orders Excel
                    </a>
                    <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exportDateRangeModal" title="Advanced Export Options">
                        <i class="bi bi-gear"></i> Advanced
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Date Range Export Modal -->
<div class="modal fade" id="exportDateRangeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #E8521A 0%, #4A6741 100%); color: white;">
                <h5 class="modal-title">Advanced Export Options</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="GET" id="advancedExportForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}">
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date', now()->format('Y-m-d')) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Export Format</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="export_type" id="excel_export" value="excel" checked>
                                <label class="form-check-label" for="excel_export">
                                    <i class="bi bi-file-earmark-spreadsheet"></i> Excel (Recommended for large datasets)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="export_type" id="pdf_export" value="pdf">
                                <label class="form-check-label" for="pdf_export">
                                    <i class="bi bi-file-earmark-pdf"></i> PDF (Professional format)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" onclick="submitAdvancedExport(event)">
                        <i class="bi bi-download"></i> Export
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function submitAdvancedExport(e) {
    e.preventDefault();
    const startDate = document.getElementById('start_date').value;
    const endDate = document.getElementById('end_date').value;
    const exportType = document.querySelector('input[name="export_type"]:checked').value;
    
    if (exportType === 'excel') {
        window.location.href = `{{ route('sales.export.orders') }}?start_date=${startDate}&end_date=${endDate}`;
    } else {
        window.location.href = `{{ route('sales.export.pdf') }}?start_date=${startDate}&end_date=${endDate}`;
    }
}
</script>

<!-- Sales Metrics Grid -->
<div class="row mb-4">
    <!-- Revenue Card -->
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="sales-metric-card">
            <div class="metric-header">
                <div>
                    <p class="metric-label">Total Revenue</p>
                    <h3 class="metric-value">৳ {{ number_format($currentMonthRevenue, 0) }}</h3>
                </div>
                <div class="metric-icon" style="color: #E8521A;">
                    <i class="bi bi-cash-coin"></i>
                </div>
            </div>
            <div class="metric-footer">
                <span class="metric-change @if($revenueChange >= 0) positive @else negative @endif">
                    <i class="bi @if($revenueChange >= 0) bi-arrow-up @else bi-arrow-down @endif"></i>
                    {{ abs($revenueChange) }}%
                </span>
                <span class="metric-period">vs last month</span>
            </div>
        </div>
    </div>

    <!-- Orders Card -->
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="sales-metric-card">
            <div class="metric-header">
                <div>
                    <p class="metric-label">Total Orders</p>
                    <h3 class="metric-value">{{ $currentMonthOrders }}</h3>
                </div>
                <div class="metric-icon" style="color: #4A6741;">
                    <i class="bi bi-bag-check"></i>
                </div>
            </div>
            <div class="metric-footer">
                <span class="metric-change @if($ordersChange >= 0) positive @else negative @endif">
                    <i class="bi @if($ordersChange >= 0) bi-arrow-up @else bi-arrow-down @endif"></i>
                    {{ abs($ordersChange) }}%
                </span>
                <span class="metric-period">vs last month</span>
            </div>
        </div>
    </div>

    <!-- Average Order Value Card -->
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="sales-metric-card">
            <div class="metric-header">
                <div>
                    <p class="metric-label">Avg Order Value</p>
                    <h3 class="metric-value">৳ {{ number_format($currentMonthAOV, 0) }}</h3>
                </div>
                <div class="metric-icon" style="color: #E8521A;">
                    <i class="bi bi-graph-up"></i>
                </div>
            </div>
            <div class="metric-footer">
                <span class="metric-change @if($aovChange >= 0) positive @else negative @endif">
                    <i class="bi @if($aovChange >= 0) bi-arrow-up @else bi-arrow-down @endif"></i>
                    {{ abs($aovChange) }}%
                </span>
                <span class="metric-period">vs last month</span>
            </div>
        </div>
    </div>

    <!-- Conversion Card -->
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="sales-metric-card">
            <div class="metric-header">
                <div>
                    <p class="metric-label">This Month</p>
                    <h3 class="metric-value">{{ \Carbon\Carbon::now()->format('M Y') }}</h3>
                </div>
                <div class="metric-icon" style="color: #C4B5A0;">
                    <i class="bi bi-calendar"></i>
                </div>
            </div>
            <div class="metric-footer">
                <span class="metric-period">{{ \Carbon\Carbon::now()->format('d M - ') }} {{ \Carbon\Carbon::now()->endOfMonth()->format('d M') }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Top Products -->
    <div class="col-lg-7 mb-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <div>
                    <h5 class="admin-card-title">Top Selling Products</h5>
                    <p class="admin-card-subtitle">Best performing products this month</p>
                </div>
                <div class="admin-card-stats">
                    <span class="stat-badge">{{ count($topProducts) }} Products</span>
                </div>
            </div>
            <div class="admin-card-body">
                @if(count($topProducts) > 0)
                    <div class="top-products-list">
                        @foreach($topProducts as $index => $product)
                            <div class="product-rank-item">
                                <div class="rank-number">{{ $index + 1 }}</div>
                                <div class="product-details">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-rank-image">
                                    <div>
                                        <h6 class="product-rank-name">{{ $product->name }}</h6>
                                        <p class="product-rank-meta">
                                            <span class="quantity-sold">{{ $product->total_quantity }} sold</span>
                                            <span class="price">৳ {{ number_format($product->price) }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="product-rank-revenue">
                                    <strong class="revenue-amount">৳ {{ number_format($product->total_revenue, 0) }}</strong>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-box-seam"></i>
                        <p>No sales data available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sales by Status -->
    <div class="col-lg-5 mb-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <div>
                    <h5 class="admin-card-title">Sales by Status</h5>
                    <p class="admin-card-subtitle">Order status breakdown</p>
                </div>
            </div>
            <div class="admin-card-body">
                @if(count($salesByStatus) > 0)
                    <div class="status-breakdown">
                        @foreach($salesByStatus as $status)
                            <div class="status-item">
                                <div class="status-info">
                                    <span class="status-badge status-{{ $status->status }}">
                                        <i class="bi bi-circle-fill"></i>
                                        {{ ucfirst($status->status) }}
                                    </span>
                                    <span class="status-count">{{ $status->count }} orders</span>
                                </div>
                                <div class="status-revenue">
                                    <strong>৳ {{ number_format($status->revenue, 0) }}</strong>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-graph-up"></i>
                        <p>No order data available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Daily Sales Chart -->
<div class="row">
    <div class="col-lg-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <div>
                    <h5 class="admin-card-title">Daily Sales Trend</h5>
                    <p class="admin-card-subtitle">This month's daily revenue</p>
                </div>
            </div>
            <div class="admin-card-body">
                @if(count($dailySales) > 0)
                    <div class="daily-sales-table">
                        <table class="table table-sm">
                            <thead class="table-header">
                                <tr>
                                    <th>Date</th>
                                    <th>Orders</th>
                                    <th>Revenue</th>
                                    <th>Average</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dailySales as $day)
                                    <tr>
                                        <td>
                                            <strong>{{ \Carbon\Carbon::parse($day->date)->format('M d, D') }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $day->orders }}</span>
                                        </td>
                                        <td>
                                            <strong class="text-success">৳ {{ number_format($day->revenue, 0) }}</strong>
                                        </td>
                                        <td>
                                            <small class="text-muted">৳ {{ number_format($day->revenue / $day->orders, 0) }}</small>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-graph-up"></i>
                        <p>No sales data for this month</p>
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

/* Sales Metric Cards */
.sales-metric-card {
    background: white;
    border-radius: 0.75rem;
    border: 1px solid var(--border);
    padding: 1.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    height: 100%;
}

.sales-metric-card:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.metric-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
}

.metric-label {
    font-size: 0.9rem;
    color: var(--gray-500);
    margin: 0;
    font-weight: 500;
}

.metric-value {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--ink);
    margin: 0.5rem 0 0 0;
}

.metric-icon {
    width: 50px;
    height: 50px;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    background: rgba(232, 82, 26, 0.1);
}

.metric-footer {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.85rem;
}

.metric-change {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-weight: 600;
}

.metric-change.positive {
    color: #10b981;
}

.metric-change.negative {
    color: #ef4444;
}

.metric-period {
    color: var(--gray-500);
}

/* Admin Card */
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

/* Top Products */
.top-products-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.product-rank-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: rgba(232, 82, 26, 0.02);
    border-radius: 0.5rem;
    transition: all 0.2s ease;
}

.product-rank-item:hover {
    background: rgba(232, 82, 26, 0.05);
}

.rank-number {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--accent);
    width: 40px;
    text-align: center;
}

.product-details {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
}

.product-rank-image {
    width: 45px;
    height: 45px;
    border-radius: 0.35rem;
    object-fit: cover;
    border: 1px solid var(--border);
}

.product-rank-name {
    font-weight: 600;
    color: var(--ink);
    margin: 0;
    font-size: 0.95rem;
}

.product-rank-meta {
    font-size: 0.85rem;
    color: var(--gray-500);
    margin: 0.25rem 0 0 0;
    display: flex;
    gap: 0.5rem;
}

.quantity-sold {
    background: rgba(232, 82, 26, 0.1);
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    color: var(--accent);
}

.price {
    background: rgba(74, 103, 65, 0.1);
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    color: var(--sage);
}

.product-rank-revenue {
    text-align: right;
}

.revenue-amount {
    color: #10b981;
    font-size: 0.95rem;
}

/* Status Breakdown */
.status-breakdown {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.status-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
    background: rgba(232, 82, 26, 0.02);
    border-radius: 0.5rem;
    border-left: 3px solid var(--accent);
}

.status-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
}

.status-badge {
    padding: 0.35rem 0.75rem;
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

.status-count {
    color: var(--gray-500);
    font-size: 0.85rem;
    font-weight: 500;
}

.status-badge i {
    font-size: 0.6rem;
}

.status-revenue {
    font-weight: 600;
    color: var(--accent);
}

/* Daily Sales Table */
.daily-sales-table {
    overflow-x: auto;
}

.table {
    margin-bottom: 0;
}

.table thead {
    background: linear-gradient(135deg, rgba(232, 82, 26, 0.08) 0%, rgba(74, 103, 65, 0.08) 100%);
    border-bottom: 2px solid var(--accent);
}

.table-header th {
    font-weight: 700;
    color: var(--ink);
    padding: 1rem;
    border: none;
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background-color: rgba(232, 82, 26, 0.05);
}

.badge {
    padding: 0.4rem 0.8rem;
    border-radius: 0.35rem;
    font-size: 0.85rem;
    font-weight: 500;
}

.text-success {
    color: #10b981 !important;
}

.text-muted {
    color: var(--gray-500) !important;
}

.empty-state {
    text-align: center;
    padding: 2rem;
    color: var(--gray-500);
}

.empty-state i {
    font-size: 2.5rem;
    color: var(--gray-500);
    margin-bottom: 0.75rem;
    opacity: 0.5;
}

.empty-state p {
    margin: 0;
    font-size: 0.95rem;
}

/* Responsive */
@media (max-width: 768px) {
    .admin-page-title {
        font-size: 1.5rem;
    }

    .metric-value {
        font-size: 1.25rem;
    }

    .admin-card-title {
        font-size: 1.25rem;
    }

    .admin-card-body,
    .admin-card-header {
        padding: 1rem;
    }

    .product-rank-item {
        flex-direction: column;
        align-items: flex-start;
    }

    .product-rank-revenue {
        width: 100%;
        text-align: left;
    }

    .table {
        font-size: 0.9rem;
    }
}
</style>
@endsection
