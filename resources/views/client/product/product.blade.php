@extends('client.master')

@section('title')
    {{$products->name}}
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="py-3 py-md-4" style="background: var(--card-bg);">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{route('index')}}" style="color: var(--accent); text-decoration: none;">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('products', ['category'=>$products->category->slug])}}" style="color: var(--accent); text-decoration: none;"> {{$products->category->name}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color: var(--ink);">  {{$products->name}} </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Success Message -->
    <div class="container mt-4">
        @if ($message = Session::get('cartsuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-left: 4px solid var(--accent); background: var(--light-sage); border-radius: 8px;">
                <i class="bi bi-check-circle-fill me-2"></i>{{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Product Detail -->
    <div class="py-4 py-md-5">
        <div class="container">
            <div class="card-bg p-3 p-sm-4 p-md-5 rounded-3" style="border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                <div class="row g-3 g-md-4 g-lg-5">
                    <div class="col-md-5">
                        <div class="position-relative">
                            <img src="@image($products->image)" alt="{{$products->name}}" class="w-100 rounded-3" style="border: 1.5px solid rgba(0,0,0,0.08); padding: 1rem; background: #F5F3EF;">
                            <span class="position-absolute top-0 start-0 m-3 px-3 py-1 rounded-2" style="background: var(--sage); color: white; font-family: 'Bebas Neue', sans-serif; font-size: 0.85rem; letter-spacing: 1px;">
                                In Stock
                            </span>
                            <button class="position-absolute top-0 end-0 m-3" onclick="toggleWishlist(this)" style="background: white; border: none; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                <i class="bi bi-heart" style="font-size: 1.1rem; color: #ccc;"></i>
                            </button>
                        </div>
                        
                        <!-- Product Features -->
                        <div class="mt-3 mt-md-4 p-2 p-sm-3 rounded-3" style="background: var(--light-sage); border: 1px solid rgba(74,103,65,0.15);">
                            <div class="d-flex align-items-center gap-2 gap-sm-3 mb-2" style="font-size: 0.85rem;">
                                <i class="bi bi-shield-check" style="color: var(--sage); font-size: 1rem;"></i>
                                <span style="color: var(--ink);">100% Authentic Products</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 gap-sm-3 mb-2" style="font-size: 0.85rem;">
                                <i class="bi bi-truck" style="color: var(--sage); font-size: 1rem;"></i>
                                <span style="color: var(--ink);">Free Delivery on Orders Over ৳500</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 gap-sm-3" style="font-size: 0.85rem;">
                                <i class="bi bi-arrow-clockwise" style="color: var(--sage); font-size: 1rem;"></i>
                                <span style="color: var(--ink);">7 Days Easy Return Policy</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="product-details">
                            <!-- Category Badge -->
                            <div class="mb-2">
                                <a href="{{route('products', ['category'=>$products->category->slug])}}" class="badge" style="background: var(--light-sage); color: var(--sage); text-decoration: none; font-size: 0.75rem; font-weight: 600; letter-spacing: 1px; padding: 0.4rem 0.8rem;">
                                    {{$products->category->name}}
                                </a>
                            </div>
                            
                            <h1 style="font-family: 'Playfair Display', serif; font-size: clamp(1.5rem, 4vw, 2rem); color: var(--ink); margin-bottom: 0.5rem; line-height: 1.3;">
                                {{$products->name}}
                            </h1>
                            
                            <div class="mb-2" style="color: #999; font-size: 0.8rem;">
                                SKU: PZ-{{str_pad($products->id, 5, '0', STR_PAD_LEFT)}} | Brand: <a href="#" style="color: var(--accent); text-decoration: none; font-weight: 600;">{{$products->brand}}</a>
                            </div>

                            <div class="product-rating mb-3 d-flex align-items-center gap-2" style="font-size: 0.85rem;">
                                <div>
                                    <i class="bi bi-star-fill" style="color: #F5A623;"></i>
                                    <i class="bi bi-star-fill" style="color: #F5A623;"></i>
                                    <i class="bi bi-star-fill" style="color: #F5A623;"></i>
                                    <i class="bi bi-star-fill" style="color: #F5A623;"></i>
                                    <i class="bi bi-star-half" style="color: #F5A623;"></i>
                                </div>
                                <span style="color: #777; font-size: 0.9rem;">(4.5/5 · 127 reviews)</span>
                            </div>
                            
                            <div class="mb-3 pb-3 pb-md-4" style="border-bottom: 2px solid rgba(0,0,0,0.06);">
                                <div style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 8vw, 3rem); color: var(--accent); line-height: 1;">
                                    ৳{{$products->price}}
                                </div>
                                <div style="color: #999; font-size: 0.8rem; margin-top: 0.25rem;">
                                    <i class="bi bi-info-circle me-1"></i> Tax included. Shipping calculated at checkout.
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <h6 style="color: var(--ink); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.9rem;">Description:</h6>
                                <p style="color: #777; line-height: 1.8; margin: 0;">
                                    {{$products->description}}
                                </p>
                            </div>

                            <!-- Quantity & Add to Cart -->
                            <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data" class="mb-3 mb-md-4">
                                @csrf
                                <input type="hidden" value="{{ $products->id }}" name="id">
                                <input type="hidden" value="{{ $products->name }}" name="name">
                                <input type="hidden" value="{{ $products->price }}" name="price">
                                <input type="hidden" value="{{ $products->image }}" name="image">
                                
                                <div class="d-flex flex-column flex-sm-row gap-3 align-items-stretch align-items-sm-center">
                                    <div class="d-flex align-items-center" style="border: 1.5px solid rgba(0,0,0,0.1); border-radius: 4px; overflow: hidden;">
                                        <button type="button" onclick="decreaseQty()" style="background: transparent; border: none; padding: 0.75rem 1rem; color: var(--ink); font-size: 1.2rem; cursor: pointer;">−</button>
                                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="99" readonly style="width: 60px; text-align: center; border: none; outline: none; font-weight: 600; color: var(--ink);">
                                        <button type="button" onclick="increaseQty()" style="background: transparent; border: none; padding: 0.75rem 1rem; color: var(--ink); font-size: 1.2rem; cursor: pointer;">+</button>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-dark flex-grow-1" style="background: var(--ink); border: none; padding: 0.85rem 2rem; border-radius: 4px; font-family: 'Bebas Neue', sans-serif; font-size: 1.1rem; letter-spacing: 1px; transition: background 0.2s;">
                                        <i class="bi bi-bag-plus me-2"></i> Add to Cart
                                    </button>
                                </div>
                            </form>
                            
                            <div class="pt-3 pt-md-4" style="border-top: 1px solid rgba(0,0,0,0.08);">
                                <div style="color: #777; font-size: 0.8rem; margin-bottom: 0.5rem; font-weight: 600;">Share this product:</div>
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-sm" style="background: #4267B2; color: white; border: none; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 4px; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm" style="background: #1DA1F2; color: white; border: none; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 4px; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                        <i class="bi bi-twitter"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm" style="background: #0A66C2; color: white; border: none; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 4px; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm" style="background: #25D366; color: white; border: none; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 4px; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function increaseQty() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            if (currentValue < 99) {
                input.value = currentValue + 1;
            }
        }
        
        function decreaseQty() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }
        
        function toggleWishlist(btn) {
            const icon = btn.querySelector('i');
            if(icon.classList.contains('bi-heart')) {
                icon.classList.replace('bi-heart', 'bi-heart-fill');
                icon.style.color = '#E8521A';
            } else {
                icon.classList.replace('bi-heart-fill', 'bi-heart');
                icon.style.color = '#ccc';
            }
        }
    </script>

    <!-- Related Products -->
    <div class="py-5" style="background: var(--light-sage);">
        <div class="container">
            <h2 class="text-center mb-5" style="font-family: 'Playfair Display', serif; font-size: 2.5rem; color: var(--ink);">Related <em style="color: var(--accent);">Products</em></h2>
            <div class="row g-4">
                @foreach($relatedfoods as $food)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-card" style="border: 1px solid var(--border); border-radius: 0.75rem; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <div class="product-img-wrap">
                                <a href="{{route('product', [$food->category, $food])}}">
                                    <img src="@image($food->image)" alt="{{$food->name}}">
                                </a>
                                <div class="product-wishlist" onclick="toggleWishlist(this)">
                                    <i class="bi bi-heart"></i>
                                </div>
                            </div>
                            
                            <div class="product-body">
                                <div class="product-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                    <span>(4.5)</span>
                                </div>
                                
                                <h3 class="product-name">
                                    <a href="{{route('product', [$food->category, $food])}}" style="text-decoration: none; color: var(--ink);">
                                        {{$food->name}}
                                    </a>
                                </h3>
                                
                                <div class="product-footer">
                                    <div class="product-price">
                                        ৳{{$food->price}}
                                    </div>
                                    
                                    <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $food->id }}" name="id">
                                        <input type="hidden" value="{{ $food->name }}" name="name">
                                        <input type="hidden" value="{{ $food->price }}" name="price">
                                        <input type="hidden" value="{{ $food->image }}" name="image">
                                        <input type="hidden" value="1" name="quantity">
                                        <button type="submit" class="btn-add-cart">
                                            <i class="bi bi-bag-plus"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
