@extends('admin.master')
@php
    $page = 'manage-products'
@endphp
@section('title')
    Manage Products
@endsection

@section('content')

    <div class="pagetitle">
        <h1>Manage Post</h1>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Post</li>
            </ol>
        </nav>
    </div>
    @if(session()->has('success'))
        <div class="container-fluid">
            <div class="alert w-100 alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <section class="section">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">
                    Manage Post
                </h5>
                <table id="datatable" class="table table-border table-striped" style="width:100%">
                    <thead>
                    <tr>

                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($products as $product)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->cat_name}}</td>
                            <td>{{$product->brand}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->description}}</td>
                            <td>
                                <img src="{{ asset($product->image)}}"
                                     alt=""
                                     height="50px" width="50px">

                            </td>
                            <td>
                                <a href="add-post.php?id=13"
                                   class="btn-sm btn btn-warning">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <a href="{{route('delete.product', ['id'=>$product->id])}}"
                                   class="btn-sm btn btn-danger">
                                    <i class="bx bxs-trash-alt"></i>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.j
    s"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>
@endsection
