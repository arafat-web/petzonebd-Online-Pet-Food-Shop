@extends('admin.master')
@php
    $page = 'manage-categories'
@endphp
@section('title')
    Manage Categories
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Manage Categories</h1>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Categories</li>
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
        <div class="row">
            <div class="col-md-6 col-sm-6 col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">

                        @if( isset($edit) && $edit  === 'true')
                            <h5 class="card-title fw-bold">
                                Update Category
                            </h5>
                            <form class="add-form" action="{{route('update.category')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 mt-3">
                                    <input type="hidden"
                                           value="{{$category->id}}"
                                           name="id">
                                    <label for="cat_name">Category Name:</label>
                                    <input type="text" class="form-control mb-2" id="cat_name"
                                           placeholder="Enter Category Name"
                                           value="{{$category->name}}"
                                           name="cat_name" required>
                                    <label for="cat_slug">Category Slug:</label>
                                    <input type="text" class="form-control" id="cat_slug"
                                           placeholder="Enter Slug Name"
                                           value="{{$category->slug}}"
                                           name="cat_slug" required>
                                    <span style="font-size: 12px;" class="text-danger d-block">*Slug should be unique</span>
                                    <label for="cat_name">Category Image:</label>
                                    <input type="file" class="form-control" id="cat_img" name="cat_img" required>
                                    <img class="img_fluid d-block mt-3" width="200px" height="200px" src="{{asset($category->cat_image)}}" alt="{{$category->name}}">
                                    <input type="hidden"
                                           value="{{$category->cat_image}}"
                                           name="img_path">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </form>
                        @else
                            <h5 class="card-title fw-bold">
                                Add Category
                            </h5>
                            <form class="add-form" action="{{route('add.category')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 mt-3">
                                    <label for="cat_name">Category Name:</label>
                                    <input type="text" class="form-control mb-2" id="cat_name"
                                           placeholder="Enter Category Name"
                                           value=""
                                           name="cat_name" required>
                                    <label for="cat_name">Category Slug:</label>
                                    <input type="text" class="form-control" id="cat_slug"
                                           placeholder="Enter Slug Name"
                                           value=""
                                           name="cat_slug" required>
                                    <span style="font-size: 12px;" class="text-danger d-block">*Slug should be unique</span>
                                    <label for="cat_name">Category Image:</label>
                                    <input type="file" class="form-control" id="cat_img" name="cat_img" required>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3 fw-bold">Categories</h5>

                        <table class="table text-center table-bordered table-hover bg-white">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 1; @endphp
                            @foreach($categories as $cat)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$cat->name}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-warning"
                                           href="{{route('edit.category', ['id'=>$cat->id])}}">
                                            <i class='bx bx-edit'></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger"
                                           href="{{route('delete.category', ['id'=>$cat->id])}}"
                                           onclick="return confirm('Are Sure Wants Delete This!!')"
                                        >
                                            <i class='bx bxs-trash-alt'></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
