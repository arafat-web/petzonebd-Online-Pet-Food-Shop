@extends('client.master')

@section('bg-color')
    style="background-color: #ebeaea;"
@endsection

@section('title')
    Cart
@endsection

@section('content')
    <div class="navigation py-4">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Cart</li>
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

    <div class="container mb-4">
        <div class="row">
            <aside class="col-lg-9">
                <div class="card pt-2">
                    <div class="table-responsive">
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th scope="col" class="text-center">Image</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col" class="text-right d-none d-md-block">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($cartItems as $item)
                            <tr>
                                <td>
                                    <img src="{{$item->attributes->image}}" class="img-fluid" width="100px">
                                </td>
                                <td>
                                    <a href="#" class="text-dark">{{ $item->name }}</a>
                                </td>
                                <td width="100px">
                                    <form class="d-inline" action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id}}" >
                                        <div class="input-group">
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" class="form-control form-control-sm">
                                            <button style="font-size: 14px;" class="input-group-text"> <i class="fa-solid fa-pen"></i></button>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <div class="price-wrap">
                                        <b class="price"> ৳{{ $item->price * $item->quantity }}</b>
                                        <small class="text-muted d-block">
                                            ৳{{ $item->price }} for each
                                        </small>
                                    </div>
                                </td>
                                <td class="text-right d-none d-md-block">
                                    <form class="d-inline" action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                        <button class="btn btn-light"> <i class="fa-solid fa-trash"></i></button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                            <tr>

                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </aside>
            <aside class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <dl class="dlist-align">
                            <span class="fw-bold">Total price:</span>
                            <span class="text-right ml-3"> ৳{{ Cart::getTotal() }}</span>
                        </dl>
                        <dl class="dlist-align">
                            <span class="fw-bold">Discount:</span>
                            <span class="text-right text-danger ml-3"> -0</span>
                        </dl>
                        <dl class="dlist-align">
                            <span class="fw-bold">Total:</span>
                            <span class="text-right text-dark b ml-3"> ৳{{ Cart::getTotal() }}</span>
                        </dl>
                        <hr>
                        <div class="text-center">
                            <a href="#" class="btn btn-out btn-primary btn-square btn-main"> Checkout <i class="fa-solid fa-circle-arrow-right"></i></a>
                            <a href="#" class="btn btn-out btn-success btn-square btn-main mt-2"><i class="fa-solid fa-circle-arrow-left"></i> Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection
