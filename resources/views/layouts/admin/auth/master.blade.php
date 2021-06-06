<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--=== Favicon ===-->
    @include('layouts.common.icon')
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('all-assets/common/bootstrap-4.5/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('all-assets/common/fontawesom5.7/css/all.min.css') }}" >
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('all-assets/admin/assets/plugins/animation/css/animate.min.css') }}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('all-assets/admin/assets/css/style-admin.css') }}">

    @livewireStyles
</head>
<body>
  
    
    @yield('content')


    <script>
       //Show Password
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    @livewireScripts
</body>
</html>
