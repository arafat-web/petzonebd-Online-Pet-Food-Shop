<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('admin')}}/assets/bootstrap.min.css" rel="stylesheet">
    <script src="{{asset('admin')}}/assets/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/nv9zuc0lfdy6f2dqpbokjbvbqqbtsynetmcbhwwrs2c0t7no/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset('admin')}}/assets/style.css">
    <script src="{{asset('admin')}}/assets/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
</head>
<body id="body-pd">
@include('admin.include.header')
@include('admin.include.sidebar')
<main>
    @yield('content')
</main>
@include('admin.include.footer')
<script src="{{asset('admin')}}/assets/script.js"></script>
</body>

</html>
