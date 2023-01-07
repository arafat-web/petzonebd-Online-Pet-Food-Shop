<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetZoneBD - @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('client')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('client')}}/css/style.css">
</head>
<body>

<div class="container-fluid" @yield('bg-color')>
    @include('client.include.header')
    @yield('content')
    @include('client.include.footer')
</div>

<script src="{{asset('client')}}/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('client')}}/js/script.js"></script>
</body>

</html>
