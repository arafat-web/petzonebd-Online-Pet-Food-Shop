@extends('client.master')

@section('title')
    {{$cat_name->name}}
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="py-3 py-md-4" style="background: var(--card-bg);">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{route('index')}}" style="color: var(--accent); text-decoration: none;">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color: var(--ink);"> {{$cat_name->name}} </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Page Header -->
    <div class="py-3 py-md-4" style="background: var(--light-sage);">
        <div class="container">
            <div class="text-center">
                <h1 style="font-family: 'Bebas Neue', sans-serif; font-size: clamp(2rem, 6vw, 3rem); color: var(--ink); margin: 0;">
                    {{$cat_name->name}}
                </h1>
                <p style="color: #777; margin-top: 0.5rem; font-size: 0.9rem;">
                    Premium quality products for your beloved pets
                </p>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    <div class="container mt-3 mt-md-4">
        @if ($message = Session::get('cartsuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-left: 4px solid var(--accent); background: var(--light-sage); border-radius: 8px;">
                <i class="bi bi-check-circle-fill me-2"></i>{{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Products Grid -->
    <div class="py-4 py-md-5">
        <div class="container">
            <div class="row g-4">
                @foreach($allfoods as $foods)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-card">
                            <div class="product-img-wrap">
                                <a href="{{route('product',[$foods->category, $foods])}}">
                                    <img src="@image($foods->image)" alt="{{$foods->name}}">
                                </a>
                                @if($foods->hasDiscount())
                                    <span class="product-tag" style="background: var(--accent);">-{{ $foods->getDiscountPercentage() }}%</span>
                                @else
                                    <span class="product-tag">In Stock</span>
                                @endif
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
                                    <a href="{{route('product',[$foods->category, $foods])}}" style="text-decoration: none; color: var(--ink);">
                                        {{$foods->name}}
                                    </a>
                                </h3>
                                
                                <div class="product-footer">
                                    <div class="product-price">
                                        ৳{{ $foods->getDisplayPrice() }}
                                        @if($foods->hasDiscount())
                                            <span class="product-price-old">৳{{ $foods->price }}</span>
                                        @endif
                                    </div>
                                    
                                    <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $foods->id }}" name="id">
                                        <input type="hidden" value="{{ $foods->name }}" name="name">
                                        <input type="hidden" value="{{ $foods->getDisplayPrice() }}" name="price">
                                        <input type="hidden" value="{{ $foods->image }}" name="image">
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

            @if($allfoods->isEmpty())
                <div class="text-center py-5">
                    <div style="font-size: 4rem; opacity: 0.3;">📦</div>
                    <h3 style="font-family: 'Bebas Neue', sans-serif; color: var(--ink); margin-top: 1rem;">
                        No Products Found
                    </h3>
                    <p style="color: #777;">
                        We're currently updating our inventory. Check back soon!
                    </p>
                    <a href="{{route('index')}}" class="btn btn-dark mt-3" style="background: var(--ink); border: none; padding: 0.75rem 2rem; border-radius: 4px;">
                        <i class="bi bi-house-fill me-2"></i>Back to Home
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
