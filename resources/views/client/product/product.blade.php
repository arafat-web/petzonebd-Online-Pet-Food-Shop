@extends('client.master')

@section('bg-color')
    style="background-color: #ebeaea;"
@endsection
@section('title')
    {{$products->name}}
@endsection

@section('content')
    <div class="navigation py-4">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{route('products', ['id'=>$products->cat_id])}}"> {{$products->cat_name}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">  {{$products->name}} </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        @if ($message = Session::get('cartsuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="product-display">
        <div class="container">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card-img">
                                <img src="{{asset($products->image)}}" alt="" class="card-img">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-details pt-2">
                                <h4 class="product-title">
                                    {{$products->name}}
                                </h4>
                                <h6 class="product-brand border-bottom pb-2">
                                    Brand: <a href="#">{{$products->brand}}</a>
                                </h6>
                                <h4 class="product-price pt-4">
                                    Price:
                                    <span class="text-danger fw-bolder">
                                            ৳ {{$products->price}}
                                        </span>

                                </h4>
                                <h6 class="product-status" style="font-size: 14px;">
                                    Status: <span class="text-success">In Stock</span>
                                </h6>

                                <h6 class="product-category pb-2">
                                    Category: <a
                                        href="{{route('products', ['id'=>$products->cat_id])}}">{{$products->cat_name}}</a>
                                </h6>
                                <p class="product-description text-black-50" style="text-align: justify;">
                                    {{$products->description}}
                                </p>

                                <div class="action-buttons pt-2 border-bottom pb-2">
                                    <form action="{{ route('cart.store') }}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $products->id }}" name="id">
                                        <input type="hidden" value="{{ $products->name }}" name="name">
                                        <input type="hidden" value="{{ $products->price }}" name="price">
                                        <input type="hidden" value="{{ $products->image }}" name="image">
                                        <input type="hidden" value="1" name="quantity">
                                        <button class="btn btn-success">Add To Cart</button>
                                    </form>
                                </div>
                                <div class="social-share pt-4">
                                    <a class="icon" style="background-color: #4267B2;" href=""><i
                                            class="fa-brands fa-facebook"></i></a>
                                    <a class="icon" style="background-color: #1DA1F2;" href=""><i
                                            class="fa-brands fa-twitter"></i></a>
                                    <a class="icon" style="background-color: #DB4437;" href=""><i
                                            class="fa-brands fa-google-plus-g"></i></a>
                                    <a class="icon" style="background-color:  #4C75A3;" href=""><i
                                            class="fa-brands fa-vk"></i></a>
                                    <a class="icon" style="background-color: #0A66C2;" href=""><i
                                            class="fa-brands fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="food mt-5 mb-5">
        <div class="container bg-white border-0 shadow-sm">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-uppercase fw-bold p-3 pb-2 border-bottom">Related Products</h4>
                </div>
            </div>
            <div class="row">
                @foreach($relatedfoods as $food)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{route('product', ['cat_id'=>$food->cat_id, 'id'=>$food->id])}}">
                                    <img src="{{asset($food->image)}}" alt="" class="card-img">
                                </a>
                                <h6 class="card-text text-primary pt-3 fw-light">
                                    <a href="#">
                                        {{$food->name}}
                                    </a>
                                </h6>
                                <div class="card-price text-danger pb-2 ps-2">
                                    ৳ {{$food->price}}.00
                                    <del class="text-black-50"> ৳ 400.00</del>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
