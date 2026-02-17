<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div> <a href="{{route('dashboard')}}" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                    class="nav_logo-name">TECHBLOGBD</span> </a>
            <div class="nav_list">
                <a href="{{route('dashboard')}}" class="nav_link @if($page === 'dashboard')active @endif"> <i class='bx bx-grid-alt nav_icon'></i>
                    <span class="nav_name">Dashboard</span> </a>
                <a href="{{route('add.product')}}" class="nav_link @if($page === 'add-product')active @endif"> <i class='bx bx-add-to-queue nav_icon'></i> <span
                        class="nav_name">Add Product</span> </a>
                <a href="{{route('manage.categories')}}" class="nav_link @if($page === 'manage-categories')active @endif"> <i class='bx bx-message-alt-add nav_icon'></i>
                    <span class="nav_name">Manage
                            Category</span> </a>
                <a href="{{route('manage.products')}}" class="nav_link @if($page === 'manage-products')active @endif"> <i class='bx bxs-spreadsheet nav_icon'></i> <span
                        class="nav_name">Manage Products</span> </a>
                <a href="#" class="nav_link "> <i class='bx bxs-user-rectangle nav_icon'></i> <span
                        class="nav_name">Manage Users</span> </a>
                <a href="profile.php" class="nav_link "> <i class='bx bx-user nav_icon'></i> <span
                        class="nav_name">Profile</span>
                </a>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="nav_link" style="background: none; border: none; cursor: pointer; width: 100%; text-align: left;"> 
                <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span>
            </button>
        </form>
    </nav>
</div>
