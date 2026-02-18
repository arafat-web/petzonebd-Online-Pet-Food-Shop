<header class="admin-header">
    <div class="admin-header-content">
        <!-- Left: Menu Toggle and Logo -->
        <div class="admin-header-left">
            <button class="admin-menu-toggle" id="admin-menu-toggle">
                <i class="bi bi-list"></i>
            </button>
            <div class="admin-logo">
                <i class="bi bi-gem"></i>
                <span>Admin Panel</span>
            </div>
        </div>

        <!-- Right: User Menu -->
        <div class="admin-header-right">
            <!-- Notifications -->
            <div class="admin-header-item">
                <button class="admin-icon-btn">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-danger">3</span>
                </button>
            </div>

            <!-- User Profile -->
            <div class="admin-header-item dropdown">
                <button class="admin-user-btn" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=E8521A&color=fff" 
                         alt="Admin" class="admin-user-avatar">
                    <span class="admin-user-name">{{ auth()->user()->name }}</span>
                    <i class="bi bi-chevron-down"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end admin-user-menu">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('settings') }}"><i class="bi bi-gear"></i> Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
