<nav class="navbar navbar-expand-lg">
    <div class="container-xl">
        <a class="navbar-brand" href="{{route('index')}}">Pet<span>Zone</span></a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-label="Toggle navigation">
            <i class="bi bi-list text-white fs-4"></i>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'index') active @endif" href="{{route('index')}}">Home</a>
                </li>
                @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link @if(Route::currentRouteName() === 'products' && request()->route('category') && request()->route('category')->id === $category->id) active @endif" href="{{route('products', ['category'=>$category->slug])}}">
                            {{$category->name}}
                        </a>
                    </li>
                @endforeach
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'contact.show') active @endif" href="{{ route('contact.show') }}">Contact</a>
                </li>
            </ul>
            <div class="navbar-icons d-flex align-items-center">
                <a href="#"><i class="bi bi-search"></i></a>
                <a href="{{route('cart.list')}}" class="cart-badge position-relative">
                    <i class="bi bi-bag"></i>
                    <span class="cart-badge-count">{{ Cart::getTotalQuantity()}}</span>
                </a>
                @auth
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle navbar-dropdown-toggle" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="background: var(--ink); border: 1px solid rgba(250,247,242,.15); border-radius: 0.5rem;">
                            @if(auth()->user()->isAdmin())
                                <li><a class="dropdown-item navbar-dropdown-item" href="{{ route('admin.dashboard') }}" style="color: rgba(250,247,242,.8); font-size: 0.9rem; margin-left: 0px;">
                                    <i class="bi bi-speedometer2 me-2"></i> Admin Dashboard
                                </a></li>
                                <li><a class="dropdown-item navbar-dropdown-item" href="{{ route('profile.show') }}" style="color: rgba(250,247,242,.8); font-size: 0.9rem; margin-left: 0px;">
                                    <i class="bi bi-person me-2"></i> Profile
                                </a></li>
                            @else
                                <li><a class="dropdown-item navbar-dropdown-item" href="{{ route('user.dashboard') }}" style="color: rgba(250,247,242,.8); font-size: 0.9rem; margin-left: 0px;">
                                    <i class="bi bi-speedometer2 me-2"></i> My Dashboard
                                </a></li>
                                <li><a class="dropdown-item navbar-dropdown-item" href="{{ route('user.dashboard') }}" style="color: rgba(250,247,242,.8); font-size: 0.9rem; margin-left: 0px;">
                                    <i class="bi bi-bag-check me-2"></i> My Orders
                                </a></li>
                                <li><a class="dropdown-item navbar-dropdown-item" href="{{ route('user.profile') }}" style="color: rgba(250,247,242,.8); font-size: 0.9rem; margin-left: 0px;">
                                    <i class="bi bi-person-gear me-2"></i> Edit Profile
                                </a></li>
                            @endif
                            <li><hr class="dropdown-divider" style="border-color: rgba(250,247,242,.1); margin: 0.5rem 0;"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item navbar-dropdown-item" style="color: rgba(250,247,242,.8); font-size: 0.9rem; border: none; background: none; width: 100%; text-align: left;">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{route('client.login')}}" title="Login"><i class="bi bi-person"></i></a>
                @endauth
            </div>
        </div>
    </div>

    <style>
        .navbar-nav .nav-link {
            color: var(--ink);
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: var(--accent);
        }
        .navbar-nav .nav-link.active {
            color: var(--accent);
            font-weight: 600;
        }
        .cart-badge {
            color: var(--ink);
            position: relative;
            transition: color 0.3s ease;
        }
        .cart-badge:hover {
            color: var(--accent);
        }
        .cart-badge-count {
            position: absolute;
            top: -8px;
            right: -10px;
            background: var(--accent);
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .navbar-dropdown-toggle {
            color: var(--ink);
            transition: color 0.3s ease;
        }
        .navbar-dropdown-toggle:hover {
            color: var(--accent);
        }
        .navbar-dropdown-item:hover {
            background: rgba(232, 82, 26, 0.1);
            color: var(--accent) !important;
        }
    </style>


</nav>
