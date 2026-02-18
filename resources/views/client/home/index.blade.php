@extends('client.master')

@section('bg-color')
@endsection

@section('title')
    Animal Food Shop In Bangladesh
@endsection

@php
    $cat_ids = '';
@endphp

@section('content')
    <!-- ══════════ HERO ══════════ -->
    <section class="hero">
        <div class="container-xl">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6">
                    <div class="hero-eyebrow">Premium Pet Nutrition</div>
                    <h1>Feed Their<br><em>Wild</em><br>Nature</h1>
                    <p class="hero-desc">
                        Scientifically crafted, vet-approved meals that keep your beloved companions thriving — because they
                        deserve nothing but the finest.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <button class="btn-hero" onclick="window.location='{{ route('products', ['category' => 'cat-food']) }}'">Shop
                            Now</button>
                        <button class="btn-outline-hero" onclick="window.location='{{ route('index') }}'">Explore
                            Range</button>
                    </div>
                    <div class="hero-stats">
                        <div>
                            <div class="hero-stat-num">{{ \App\Models\Product::count() }}+</div>
                            <div class="hero-stat-label">Products</div>
                        </div>
                        <div>
                            <div class="hero-stat-num">50<span>k</span></div>
                            <div class="hero-stat-label">Happy Pets</div>
                        </div>
                        <div>
                            <div class="hero-stat-num">15<span>+</span></div>
                            <div class="hero-stat-label">Years Trust</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-frame">
                        <div class="hero-cat-area d-flex align-items-end justify-content-center">
                            <svg viewBox="0 0 480 580" xmlns="http://www.w3.org/2000/svg"
                                style="width:100%;height:100%;position:absolute;inset:0;">
                                <circle cx="240" cy="300" r="260" fill="#2E2E2C" />
                                <circle cx="240" cy="300" r="180" fill="none" stroke="rgba(232,82,26,0.08)"
                                    stroke-width="40" />
                                <circle cx="240" cy="300" r="130" fill="none" stroke="rgba(232,82,26,0.05)"
                                    stroke-width="20" />
                                <text x="80" y="420" font-family="Georgia,serif" font-size="200"
                                    fill="rgba(250,247,242,0.04)" font-weight="900">#1</text>
                                <text x="140" y="380" font-size="200" class="float-anim">🐱</text>
                                <text x="170" y="490" font-size="90">🥣</text>
                            </svg>
                        </div>
                        <div class="hero-badge">
                            <strong>30%</strong> Off Today
                        </div>
                        <div class="hero-tag">
                            <i class="bi bi-patch-check-fill"></i>
                            <span>Vet Approved Recipes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════ MARQUEE ══════════ -->
    <div class="marquee-band">
        <div class="marquee-inner">
            <span class="marquee-item">Premium Cat Food</span>
            <span class="marquee-item">Natural Dog Nutrition</span>
            <span class="marquee-item">Free Delivery Over ৳1000</span>
            <span class="marquee-item">Vet Approved Formulas</span>
            <span class="marquee-item">100% Natural Ingredients</span>
            <span class="marquee-item">Bird & Rabbit Specials</span>
            <span class="marquee-item">Premium Cat Food</span>
            <span class="marquee-item">Natural Dog Nutrition</span>
            <span class="marquee-item">Free Delivery Over ৳1000</span>
            <span class="marquee-item">Vet Approved Formulas</span>
            <span class="marquee-item">100% Natural Ingredients</span>
            <span class="marquee-item">Bird & Rabbit Specials</span>
        </div>
    </div>

    <!-- ══════════ CATEGORIES ══════════ -->
    <section class="categories-section">
        <div class="container-xl">
            <div class="row align-items-end mb-5">
                <div class="col-md-7">
                    <div class="section-eyebrow">Shop by Category</div>
                    <h2 class="section-title">Find the Perfect<br><em>Meal</em> for Your Pet</h2>
                    <div class="section-divider"></div>
                </div>
                <div class="col-md-5 text-md-end mt-3 mt-md-0">
                    <a href="#" class="btn-view-all">View All Categories</a>
                </div>
            </div>
            <div class="row g-3 g-md-4">
                @php
                    $categoryIcons = [
                        'Cat Food' => 'bi-egg-fried',
                        'Dog Food' => 'bi-cup-hot',
                        'Bird Food' => 'bi-feather',
                        'Rabbit Food' => 'bi-flower1',
                    ];
                    $defaultIcon = 'bi-egg-fried';
                @endphp
                @foreach ($categories as $category)
                    @php
                        $icon = $categoryIcons[$category->name] ?? $defaultIcon;
                        $productCount = \App\Models\Product::where('cat_id', $category->id)->count();
                    @endphp
                    <div class="col-6 col-md-3">
                        <a href="{{ route('products', ['category' => $category->slug]) }}" style="text-decoration: none;">
                            <div class="cat-card">
                                <div class="cat-icon-wrap">
                                    <i class="bi {{ $icon }}" style="color: var(--accent)"></i>
                                </div>
                                <div class="cat-label">{{ $category->name }}</div>
                                <div class="cat-count">{{ $productCount }} products</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ══════════ CAT FOOD ══════════ -->
    <section class="products-section">
        <div class="container-xl">
            <div class="row align-items-end mb-5">
                <div class="col">
                    <div class="section-eyebrow">Best Sellers</div>
                    <h2 class="section-title">Cat <em>Food</em></h2>
                    <div class="section-divider"></div>
                </div>
                <div class="col-auto">
                    <a href="{{ route('products', ['category' => 'cat-food']) }}" class="btn-view-all">View All</a>
                </div>
            </div>
            <div class="row g-3 g-md-4">
                @php $cat_ids = 1; @endphp
                @foreach ($catfoods as $catfood)
                    <div class="col-6 col-md-3">
                        <div class="product-card h-100">
                            <div class="product-img-wrap">
                                <a href="{{ route('product', [$catfood->category, $catfood]) }}">
                                    <img src="@image($catfood->image)" alt="{{ $catfood->name }}">
                                </a>
                                @if($catfood->hasDiscount())
                                    <span class="product-tag" style="background: var(--accent);">-{{ $catfood->getDiscountPercentage() }}%</span>
                                @else
                                    <span class="product-tag">New</span>
                                @endif
                                <div class="product-wishlist"><i class="bi bi-heart"></i></div>
                            </div>
                            <div class="product-body">
                                <div class="product-category">Cat Food</div>
                                <div class="product-name">
                                    <a href="{{ route('product', [$catfood->category, $catfood]) }}"
                                        style="text-decoration: none; color: inherit;">
                                        {{ $catfood->name }}
                                    </a>
                                </div>
                                <div class="product-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                    <span>({{ rand(50, 200) }})</span>
                                </div>
                                <div class="product-footer">
                                    <div>
                                        <span class="product-price">৳{{ $catfood->getDisplayPrice() }}</span>
                                        @if($catfood->hasDiscount())
                                            <span class="product-price-old">৳{{ $catfood->price }}</span>
                                        @else
                                            @if (rand(0, 1))
                                                <span class="product-price-old">৳{{ $catfood->price + rand(200, 500) }}</span>
                                            @endif
                                        @endif
                                    </div>
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $catfood->id }}" name="id">
                                        <input type="hidden" value="{{ $catfood->name }}" name="name">
                                        <input type="hidden" value="{{ $catfood->getDisplayPrice() }}" name="price">
                                        <input type="hidden" value="@image($catfood->image)" name="image">
                                        <input type="hidden" value="1" name="quantity">
                                        <button type="submit" class="btn-add-cart"><i
                                                class="bi bi-bag-plus"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $cat_ids = $catfood->cat_id; @endphp
                @endforeach
            </div>
        </div>
    </section>

    <!-- ══════════ DOG FOOD ══════════ -->
    <section class="products-section alt-bg">
        <div class="container-xl">
            <div class="row align-items-end mb-5">
                <div class="col">
                    <div class="section-eyebrow">Top Picks</div>
                    <h2 class="section-title">Dog <em>Food</em></h2>
                    <div class="section-divider"></div>
                </div>
                <div class="col-auto">
                    <a href="{{ route('products', ['category' => 'dog-food']) }}" class="btn-view-all">View All</a>
                </div>
            </div>
            <div class="row g-3 g-md-4">
                @php $cat_ids = 2; @endphp
                @foreach ($dogfoods as $dogfood)
                    <div class="col-6 col-md-3">
                        <div class="product-card h-100">
                            <div class="product-img-wrap" style="background:#EAF0E8;">
                                <a href="{{ route('product', [$dogfood->category, $dogfood]) }}">
                                    <img src="@image($dogfood->image)" alt="{{ $dogfood->name }}">
                                </a>
                                @if($dogfood->hasDiscount())
                                    <span class="product-tag" style="background: var(--accent);">-{{ $dogfood->getDiscountPercentage() }}%</span>
                                @else
                                    <span class="product-tag">Bestseller</span>
                                @endif
                                <div class="product-wishlist"><i class="bi bi-heart"></i></div>
                            </div>
                            <div class="product-body">
                                <div class="product-category">Dog Food</div>
                                <div class="product-name">
                                    <a href="{{ route('product', [$dogfood->category, $dogfood]) }}"
                                        style="text-decoration: none; color: inherit;">
                                        {{ $dogfood->name }}
                                    </a>
                                </div>
                                <div class="product-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <span>({{ rand(100, 300) }})</span>
                                </div>
                                <div class="product-footer">
                                    <div>
                                        <span class="product-price">৳{{ $dogfood->getDisplayPrice() }}</span>
                                        @if($dogfood->hasDiscount())
                                            <span class="product-price-old">৳{{ $dogfood->price }}</span>
                                        @endif
                                    </div>
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $dogfood->id }}" name="id">
                                        <input type="hidden" value="{{ $dogfood->name }}" name="name">
                                        <input type="hidden" value="{{ $dogfood->getDisplayPrice() }}" name="price">
                                        <input type="hidden" value="@image($dogfood->image)" name="image">
                                        <input type="hidden" value="1" name="quantity">
                                        <button type="submit" class="btn-add-cart"><i
                                                class="bi bi-bag-plus"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $cat_ids = $dogfood->cat_id; @endphp
                @endforeach
            </div>
        </div>
    </section>

    <!-- Dog Food End -->
    <!-- Rabbit Food Start -->

    <!-- ══════════ BIRD + RABBIT ══════════ -->
    <section class="products-section">
        <div class="container-xl">
            <div class="row g-5">
                <!-- BIRD -->
                <div class="col-lg-6">
                    <div class="row align-items-end mb-4">
                        <div class="col">
                            <div class="section-eyebrow">Avian Care</div>
                            <h2 class="section-title" style="font-size:2rem">Bird <em>Food</em></h2>
                            <div class="section-divider"></div>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('products', ['category' => 'bird-food']) }}" class="btn-view-all"
                                style="padding:.65rem 1.5rem; font-size:.78rem;">View All</a>
                        </div>
                    </div>
                    <div class="row g-3">
                        @php $cat_ids = 3; @endphp
                        @foreach ($birdfoods as $birdfood)
                            <div class="col-6">
                                <div class="product-card h-100">
                                    <div class="product-img-wrap" style="height:160px; background:#FFF8EE;">
                                        <a
                                            href="{{ route('product', [$birdfood->category, $birdfood]) }}">
                                            <img src="@image($birdfood->image)" alt="{{ $birdfood->name }}"
                                                style="max-height: 120px;">
                                        </a>
                                        @if($birdfood->hasDiscount())
                                            <span class="product-tag" style="background: var(--accent); font-size: 0.65rem;">-{{ $birdfood->getDiscountPercentage() }}%</span>
                                        @endif
                                        <div class="product-wishlist"><i class="bi bi-heart"></i></div>
                                    </div>
                                    <div class="product-body">
                                        <div class="product-category">Bird Food</div>
                                        <div class="product-name">
                                            <a href="{{ route('product', [$birdfood->category, $birdfood]) }}"
                                                style="text-decoration: none; color: inherit;">
                                                {{ $birdfood->name }}
                                            </a>
                                        </div>
                                        <div class="product-footer">
                                            <span class="product-price">৳{{ $birdfood->getDisplayPrice() }}</span>
                                            @if($birdfood->hasDiscount())
                                                <span class="product-price-old">৳{{ $birdfood->price }}</span>
                                            @endif
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $birdfood->id }}" name="id">
                                                <input type="hidden" value="{{ $birdfood->name }}" name="name">
                                                <input type="hidden" value="{{ $birdfood->getDisplayPrice() }}" name="price">
                                                <input type="hidden" value="@image($birdfood->image)" name="image">
                                                <input type="hidden" value="1" name="quantity">
                                                <button type="submit" class="btn-add-cart"><i
                                                        class="bi bi-bag-plus"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php $cat_ids = $birdfood->cat_id; @endphp
                        @endforeach
                    </div>
                </div>

                <!-- RABBIT -->
                <div class="col-lg-6">
                    <div class="row align-items-end mb-4">
                        <div class="col">
                            <div class="section-eyebrow">Herbivore Care</div>
                            <h2 class="section-title" style="font-size:2rem">Rabbit <em>Food</em></h2>
                            <div class="section-divider"></div>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('products', ['category' => 'rabbit-food']) }}" class="btn-view-all"
                                style="padding:.65rem 1.5rem; font-size:.78rem;">View All</a>
                        </div>
                    </div>
                    <div class="row g-3">
                        @php $cat_ids = 4; @endphp
                        @foreach ($rabbitfoods as $rabbitfood)
                            <div class="col-6">
                                <div class="product-card h-100">
                                    <div class="product-img-wrap" style="height:160px; background:#F0FAF0;">
                                        <a
                                            href="{{ route('product', [$rabbitfood->category, $rabbitfood]) }}">
                                            <img src="@image($rabbitfood->image)" alt="{{ $rabbitfood->name }}"
                                                style="max-height: 120px;">
                                        </a>
                                        @if($rabbitfood->hasDiscount())
                                            <span class="product-tag" style="background: var(--accent); font-size: 0.65rem;">-{{ $rabbitfood->getDiscountPercentage() }}%</span>
                                        @endif
                                        <div class="product-wishlist"><i class="bi bi-heart"></i></div>
                                    </div>
                                    <div class="product-body">
                                        <div class="product-category">Rabbit Food</div>
                                        <div class="product-name">
                                            <a href="{{ route('product', [$rabbitfood->category, $rabbitfood]) }}"
                                                style="text-decoration: none; color: inherit;">
                                                {{ $rabbitfood->name }}
                                            </a>
                                        </div>
                                        <div class="product-footer">
                                            <span class="product-price">৳{{ $rabbitfood->getDisplayPrice() }}</span>
                                            @if($rabbitfood->hasDiscount())
                                                <span class="product-price-old">৳{{ $rabbitfood->price }}</span>
                                            @endif
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $rabbitfood->id }}" name="id">
                                                <input type="hidden" value="{{ $rabbitfood->name }}" name="name">
                                                <input type="hidden" value="{{ $rabbitfood->getDisplayPrice() }}" name="price">
                                                <input type="hidden" value="@image($rabbitfood->image)" name="image">
                                                <input type="hidden" value="1" name="quantity">
                                                <button type="submit" class="btn-add-cart"><i
                                                        class="bi bi-bag-plus"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php $cat_ids = $rabbitfood->cat_id; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════ TRUST BAR ══════════ -->
    <div class="trust-bar">
        <div class="container-xl">
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="trust-item">
                        <div class="trust-icon"><i class="bi bi-truck"></i></div>
                        <div>
                            <div class="trust-title">Free Delivery</div>
                            <div class="trust-desc">On orders over ৳1,000</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="trust-item">
                        <div class="trust-icon"><i class="bi bi-shield-check"></i></div>
                        <div>
                            <div class="trust-title">Vet Approved</div>
                            <div class="trust-desc">All formulas verified</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="trust-item">
                        <div class="trust-icon"><i class="bi bi-arrow-return-left"></i></div>
                        <div>
                            <div class="trust-title">Easy Returns</div>
                            <div class="trust-desc">30-day return policy</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="trust-item">
                        <div class="trust-icon"><i class="bi bi-headset"></i></div>
                        <div>
                            <div class="trust-title">24/7 Support</div>
                            <div class="trust-desc">Always here for you</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="info-section py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card-bg p-3 p-md-5 rounded-3 mb-3 mb-md-4">
                        <h2 class="info-title mb-4">
                            Pet Food. <em style="color: var(--accent);">Online Pet Food Delivery</em>
                        </h2>
                        <div class="about-text pt-3 text-secondary">
                            <p>
                                Who doesn’t want a pet as a friend? Sometimes, people say that having a pet is better
                                than having a big family. A pet heals our depression and loneliness.
                            </p>
                            <p>
                                Like a human, a pet also needs care and love. Having a pet is like having a child. You
                                always have to be attentive about their needs, health, and other kinds of stuff.
                            </p>

                            <p>
                                The first thing that comes to mind is your pet food. There are many types of pet food.
                                Like cat food and dog food, their preferences may be different. May a cat additionally
                                need cat litter, but not a dog. Different pets have different tastes. An owner needs to
                                buy food according to their pet’s preferences. Sometimes sick pets need special food. If
                                you have a cat, you need to arrange for cat medicine; yes you have to do it carefully.
                            </p>

                            <p>
                                Pet food is an essential thing. Human food consumption is not suitable for an animal.
                                It’s cumbersome and out of their digestion capacity. At the same time, the food of
                                different species of pets cannot be the same. What Cat and Dog eat is very different
                                from what a bird eats, so it’s need bird food. To keep our pets healthy and happy, we
                                must need to give them their food.
                            </p>

                            <p>
                                Like the way we give baby food to babies, the pet should also get pet food.
                            </p>
                        </div>
                    </div>

                    <div class="card-bg p-3 p-md-5 rounded-3 mb-3 mb-md-4">
                        <h2 class="info-title mb-4">
                            Pet Food <em style="color: var(--accent);">In Bangladesh</em>
                        </h2>
                        <div style="color: #777; line-height: 1.8;">
                            <p>
                                We can find pet food in Bangladesh in various grocery stores or super shops. Some shops
                                sell only pet foods. However, due to the limited supply of these stores, we do not get
                                all kind of pet food including rabbit food.
                            </p>
                            <p>
                                We can easily buy food from them. But this corona pandemic shows us how tough it is to
                                manage foods for our lovely pets where all the stores are off, and we cannot step
                                outside.
                            </p>
                            <p>
                                Here comes Pet Zone BD for you. We are the best online pet food shop where you’ll get
                                fresh and authentic pet food for your pets online. We are offering you various types of
                                foods for your pet.
                            </p>
                            <p>
                                Without stepping out, get your desired pet food at your doorstep from us.
                            </p>
                            <p>
                                It should be admitted with pride that Pet Zone BD has delivered all the pet foods
                                successfully to their customers within this whole corona pandemic.
                            </p>
                            <p>
                                Our clients were delighted with their pet foods, and this online pet food shop has
                                become their favourite pet food shop.
                            </p>

                        </div>
                    </div>

                    <div class="card-bg p-3 p-md-5 rounded-3 mb-3 mb-md-4">
                        <h2 class="info-title mb-4">
                            Online Pet Food Delivery <em style="color: var(--accent);">In Bangladesh</em>
                        </h2>
                        <div style="color: #777; line-height: 1.8;">
                            <p>
                                We get the fastest delivery anywhere in Bangladesh:
                            </p>
                            <p>
                                The term ‘Online delivery’ has become very famous in our country. More than 60% of
                                people in our country do shopping online. Our hectic lifestyle is not much preferable
                                for shopping physically all the time. The best solution is to purchase online and get
                                them at your doorstep.
                            </p>
                            <p>
                                Now let’s talk about online pet food delivery in Bangladesh. Pet Zone BD is the best
                                online pet food delivery service in Bangladesh that are bound to deliver the most
                                authentic and fresh food for your beloved pet within 48 hours without any hassle.
                            </p>
                            <p>
                                We have various ranges of pet foods for cats, dogs, rabbits, pigeons and birds. We have
                                our website. Customers can easily visit the website and order their desired pet food.
                            </p>
                            <p>
                                Over the whole pandemic, we has successfully delivered all the orders in Bangladesh. We
                                have our own delivery system, which gives you the fastest delivery ever.
                            </p>
                            <p>
                                We proudly the fastest and most authentic pet food delivery company in Bangladesh with
                                the most considerable amount of customer’s satisfaction.
                            </p>

                        </div>
                    </div>

                    <div class="card-bg p-3 p-md-5 rounded-3">
                        <h2 class="info-title mb-4">
                            Online Pet Food <em style="color: var(--accent);">Companies In BD</em>
                        </h2>
                        <div style="color: #777; line-height: 1.8;">
                            <p>
                                Over the last 5 to 7 years, the online delivery system has gained significant popularity
                                all over Bangladesh.
                            </p>
                            <p>
                                Most people are dependent on online delivery services. In the covid pandemic, people
                                suffered a lot in terms of buying their pet food. In Bangladesh, pet food shops are not
                                very much popular. Sometimes it isn’t easy to collect pet foods for the people who live
                                in a distant area.
                            </p>
                            <p>
                                Pet zone BD is beside these people. One of the most popular and trusted pet food
                                companies in Bangladesh is delivering a wide range of pet foods.
                            </p>
                            <p>
                                Customers can buy multiple pet foods at a time and get the safest and fastest delivery.
                                We have authentic and fresh pet foods, and packaging is top-notch.
                            </p>
                            <p>
                                Pet zone BD is always ready to provide you with food for your lovely cat at your
                                doorstep.
                            </p>
                        </div>
                        <!--  -->
                    </div>
                </div>
    </section>

    <!-- Testimonials Section -->
    <section class="info-section py-3 py-md-5" style="background: var(--light-sage);">
        <div class="container">
            <h2 class="text-center mb-4 mb-md-5"
                style="font-family: 'Playfair Display', serif; font-size: 2.5rem; color: var(--ink);">
                What <em style="color: var(--accent);">Clients Say</em>
            </h2>
            <div class="row g-3 g-md-4">
                <div class="col-md-6">
                    <div class="card-bg p-3 p-md-4 rounded-3">
                        <div class="mb-2 mb-md-3" style="font-size: 3rem;">🐕</div>
                        <h5 class="mb-3"
                            style="font-family: 'Bebas Neue', sans-serif; font-size: 1.5rem; color: var(--ink);">
                            Micky Mouse
                        </h5>
                        <p style="color: #777; line-height: 1.8;">
                            I was looking for good dog food at a cheap rate for a long time. I own three
                            dogs and it was getting tough to keep them well fed on a budget. Then a
                            friend told me about Pet Zone BD and I have been a regular customer ever
                            since. Now I can serve my dogs their delicious treats without putting a
                            strain on my budget.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-bg p-3 p-md-4 rounded-3">
                        <div class="mb-2 mb-md-3" style="font-size: 3rem;">🐱</div>
                        <h5 class="mb-3"
                            style="font-family: 'Bebas Neue', sans-serif; font-size: 1.5rem; color: var(--ink);">
                            Twinkle Wan
                        </h5>
                        <p style="color: #777; line-height: 1.8;">
                            My cat Minnie and I am a fan of Pet Zone BD. Her favorite because she loves
                            the tasty treats and mine because I can get that at an affordable price. It
                            can be a bit costly to raise a Persian cat whose entire diet almost consists
                            of cat food. Before buying from this shop, I was always anxious about the
                            cost of cat food.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
