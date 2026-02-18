<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- TinyMCE & Tagify -->
    <script src="https://cdn.tiny.cloud/1/nv9zuc0lfdy6f2dqpbokjbvbqqbtsynetmcbhwwrs2c0t7no/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css"/>
    
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
    <!-- Scripts -->
    <script src="{{asset('admin')}}/assets/jquery.min.js"></script>
    
    <!-- Admin Custom Styles -->
    <link rel="stylesheet" href="{{asset('admin')}}/assets/admin-style.css">
</head>
<body>
    @include('admin.include.header')
    @include('admin.include.sidebar')
    
    <main class="admin-main">
        @yield('content')
    </main>
    
    @include('admin.include.footer')
    <script src="{{asset('admin')}}/assets/script.js"></script>
    <script src="{{asset('admin')}}/assets/admin-script.js"></script>
</body>
</html>
