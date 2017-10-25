<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Eshop') }}</title>

    <!-- Styles -->
    <link href="{{ webpack('build/vendor.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png"  href="images/apple-icon-60x60.png">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Scripts -->
    @yield('css')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    </head>
    @yield('content')
    <script src="{{ webpack('build/vendor.js') }}"></script>
</html>
