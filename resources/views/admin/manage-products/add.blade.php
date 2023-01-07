@extends('admin.master')
@php
    $page = 'add-product'
@endphp
@section('title')
    Add Product
@endsection

@section('content')
    <div class="pagetitle">
        <h1>Add New Product</h1>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
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
                    Add New Product
                </h5>
                <form class="add-form" action="{{route('save.product')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4 mt-3">
                        <label for="name">Name:</label>
                        <input type="text" value=""
                               class="form-control" id="name" placeholder="Enter Name" name="name" required>
                    </div>
                    <div class="mb-4 mt-3">
                        <label for="price">Price:</label>
                        <input type="text" value=""
                               class="form-control" id="price" placeholder="Enter Price" name="price" required>
                    </div>
                    <div class="mb-4">
                        <label for="category">Category:</label>
                        <select class="form-control" name="category" id="category" required>
                            <option disabled selected>Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="brand">Brand:</label>
                        <input type="text" value=''
                               class="form-control" id="brand" placeholder="Enter Brand" name="brand" required>
                    </div>
                    <div class="mb-4">
                        <label for="description">Description:</label>
                        <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                </form>
            </div>
        </div>
    </section>
@endsection
