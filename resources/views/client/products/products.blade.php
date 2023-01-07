@extends('client.master')

@section('bg-color')
    style="background-color: #ebeaea;"
@endsection

@section('title')
    {{$cat_name->name}}
@endsection

@section('content')
    <div class="navigation py-4">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> {{$cat_name->name}} </li>
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
    <div class="food mb-5">
        <div class="container">
            <div class="bg-white p-3 border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        @foreach($allfoods as $foods)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="{{route('product',['cat_id'=>$foods->cat_id, 'id'=>$foods->id])}}">
                                            <img src="{{asset($foods->image)}}" alt="" class="card-img">
                                        </a>
                                        <h6 class="card-text text-primary pt-3 fw-light">
                                            <a href="{{route('product',['cat_id'=>$foods->cat_id, 'id'=>$foods->id])}}">
                                                {{$foods->name}}
                                            </a>
                                        </h6>
                                        <div class="card-price text-danger pb-2 ps-2">
                                            ৳ {{$foods->price}}.00
                                            <del class="text-black-50"> ৳ 70.00</del>
                                        </div>
                                        <div class="action-buttons pt-2">
                                            <form action="{{ route('cart.store') }}" method="POST"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" value="{{ $foods->id }}" name="id">
                                                <input type="hidden" value="{{ $foods->name }}" name="name">
                                                <input type="hidden" value="{{ $foods->price }}" name="price">
                                                <input type="hidden" value="{{ $foods->image }}" name="image">
                                                <input type="hidden" value="1" name="quantity">
                                                <button class="btn btn-success">Add To Cart</button>
                                            </form>
                                            {{--                                            <a href="#" class="btn btn-success"> Add to Cart</a>--}}
                                            <a href="#" class="btn text-white" style="background-color: purple;"> Buy
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
