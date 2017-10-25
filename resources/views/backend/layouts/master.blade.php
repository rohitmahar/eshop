<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Estylesta Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png"  href="images/apple-icon-60x60.png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('backend.layouts.header')
    @include('backend.layouts.sidebar')
    @yield('content')
    <footer class="main-footer">
        <strong>Copyright &copy; 2017 Eshop.</strong> All rights
        reserved.
    </footer>
</div>
<script src="{{ webpack('build/voardApp.js') }}"></script>
@yield('scripts')
</body>
</html>
