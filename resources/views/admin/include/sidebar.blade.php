<aside class="admin-sidebar" id="admin-sidebar">
    <div class="admin-sidebar-inner">
        <!-- Logo -->
        <div class="admin-sidebar-logo">
            <a href="{{ route('admin.dashboard') }}" class="admin-logo-link">
                <i class="bi bi-gem"></i>
                <span>PetZone</span>
            </a>
            <button class="admin-sidebar-close" id="admin-sidebar-close">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="admin-sidebar-nav">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="admin-nav-link @if($page === 'dashboard') active @endif">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <!-- Products Section -->
            <div class="admin-nav-section">
                <div class="admin-nav-section-title">Products</div>
                <a href="{{ route('add.product') }}" class="admin-nav-link @if($page === 'add-product') active @endif">
                    <i class="bi bi-plus-circle"></i>
                    <span>Add Product</span>
                </a>
                <a href="{{ route('manage.products') }}" class="admin-nav-link @if($page === 'manage-products') active @endif">
                    <i class="bi bi-boxes"></i>
                    <span>Manage Products</span>
                </a>
            </div>

            <!-- Categories Section -->
            <div class="admin-nav-section">
                <div class="admin-nav-section-title">Inventory</div>
                <a href="{{ route('manage.categories') }}" class="admin-nav-link @if($page === 'manage-categories') active @endif">
                    <i class="bi bi-tags"></i>
                    <span>Categories</span>
                </a>
            </div>

            <!-- Orders Section -->
            <div class="admin-nav-section">
                <div class="admin-nav-section-title">Orders</div>
                <a href="{{ route('manage.orders') }}" class="admin-nav-link @if($page === 'manage-orders') active @endif">
                    <i class="bi bi-bag-check"></i>
                    <span>All Orders</span>
                </a>
                <a href="{{ route('sales') }}" class="admin-nav-link @if($page === 'sales') active @endif">
                    <i class="bi bi-graph-up"></i>
                    <span>Sales & Analytics</span>
                </a>
            </div>

            <!-- Users Section -->
            <div class="admin-nav-section">
                <div class="admin-nav-section-title">Management</div>
                <a href="{{ route('manage.users') }}" class="admin-nav-link @if($page === 'manage-users') active @endif">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            </div>

            <!-- Settings Section -->
            <div class="admin-nav-section">
                <div class="admin-nav-section-title">System</div>
                <a href="{{ route('settings') }}" class="admin-nav-link @if($page === 'settings') active @endif">
                    <i class="bi bi-gear"></i>
                    <span>Settings</span>
                </a>
                <a href="#" class="admin-nav-link">
                    <i class="bi bi-question-circle"></i>
                    <span>Help</span>
                </a>
            </div>
        </nav>
    </div>
</aside>
