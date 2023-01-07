<div class="row shadow-sm mb-2 sticky-top">
    <div class="col-md-12 ">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{route('index')}}">
                    <img class="logo" src="{{asset('client')}}/img/logo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav m-auto ">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{route('index')}}">Home</a>
                        </li>
                        @foreach($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link "
                                   href="{{route('products', ['id'=>$category->id])}}">{{$category->name}}</a>
                            </li>
                        @endforeach
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a class="bg-purple btn nav-link text-white" href="#">Animal Doctor</a>--}}
{{--                        </li>--}}
                    </ul>
                    <div class="d-flex mt-3 mt-sm-0 mt-md-0 mt-lg-0">
                        <a class="btn btn-success p-2 pt-2 me-2" href="{{ route('cart.list') }}"><i
                                class="fa-solid fa-cart-shopping"></i>
                            <span style="font-size: 12px;">{{ Cart::getTotalQuantity()}}</span>
                        </a>
                        <a href="#" class="btn btn-danger p-2"><i class="fa-solid fa-right-to-bracket"></i></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
