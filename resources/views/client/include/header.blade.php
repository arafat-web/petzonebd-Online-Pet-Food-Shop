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
                <!-- Search Bar -->
                <div class="search-wrapper position-relative">
                    <form id="searchForm" class="search-form d-flex align-items-center">
                        <input type="text" id="searchInput" class="search-input" placeholder="Search products..." autocomplete="off">
                        <button type="submit" class="search-btn border-0 bg-transparent">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <div id="searchResults" class="search-results d-none"></div>
                </div>

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

        /* Search Bar Styles */
        .search-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-form {
            position: relative;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.5rem 0.75rem;
            transition: all 0.3s ease;
        }

        .search-form:focus-within {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--accent);
        }

        .search-input {
            background: transparent;
            border: none;
            outline: none;
            color: rgba(255, 255, 255, 0.9);
            padding: 0;
            font-size: 0.9rem;
            width: 120px;
            transition: width 0.3s ease;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .search-input:focus {
            width: 180px;
        }

        .search-btn {
            color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            padding: 0;
            margin-left: 0.5rem;
            transition: color 0.3s ease;
        }

        .search-btn:hover {
            color: var(--accent);
        }

        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid var(--border);
            border-top: none;
            border-radius: 0 0 4px 4px;
            max-height: 300px;
            overflow-y: auto;
            z-index: 1050;
            margin-top: 14px;
            min-width: 250px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .search-results {
               margin-top: 1px;
            }
        }

        .search-result-item {
            padding: 0.5rem 0.75rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--ink);
            text-decoration: none;
            transition: background 0.2s ease;
        }

        .search-result-item:hover {
            background: rgba(232, 82, 26, 0.08);
        }

        .search-result-img {
            width: 35px;
            height: 35px;
            border-radius: 3px;
            object-fit: cover;
            border: 1px solid var(--border);
            flex-shrink: 0;
        }

        .search-result-info {
            flex: 1;
            min-width: 0;
        }

        .search-result-name {
            font-weight: 500;
            color: var(--ink);
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 0.85rem;
        }

        .search-result-price {
            font-weight: 600;
            color: var(--accent);
            white-space: nowrap;
            flex-shrink: 0;
            font-size: 0.85rem;
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

    <script>
        let searchTimeout;
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');
        const searchForm = document.getElementById('searchForm');

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();

            if (query.length < 2) {
                searchResults.classList.add('d-none');
                return;
            }

            searchTimeout = setTimeout(() => {
                fetch(`/api/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.products && data.products.length > 0) {
                            searchResults.innerHTML = data.products.map(product => `
                                <a href="${product.url}" class="search-result-item">
                                    <img src="/public${product.image}" alt="${product.name}" class="search-result-img" onerror="this.src='/images/placeholder.png'">
                                    <div class="search-result-info">
                                        <span class="search-result-name">${product.name}</span>
                                    </div>
                                    <span class="search-result-price">৳${product.display_price}</span>
                                </a>
                            `).join('');
                            searchResults.classList.remove('d-none');
                        } else {
                            searchResults.innerHTML = '<div class="p-2 text-center text-muted" style="font-size: 0.85rem;">No products found</div>';
                            searchResults.classList.remove('d-none');
                        }
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                        searchResults.classList.add('d-none');
                    });
            }, 300);
        });

        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const query = searchInput.value.trim();
            if (query) {
                window.location.href = `/search?search=${encodeURIComponent(query)}`;
            }
        });

        // Close search results when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.search-wrapper')) {
                searchResults.classList.add('d-none');
            }
        });
    </script>


</nav>
