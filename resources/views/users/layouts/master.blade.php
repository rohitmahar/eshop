<!DOCTYPE html>
<html>
<head>
    <title>Estylesta - @yield('title')</title>
    @yield('meta-tag')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- facebook open graph protocol -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Estylesta - Your Style Partner">
    <meta property="og:description" content="Estylesta is your style partner situated at Kathmandu Nepal, Provides the better clothes to maintain your style. We are also providing tips to maintain your style in a best way.">
    <meta property="og:url" content="http://estylesta.com">
    <meta property="og:image" content="http://estylesta.com/images/style.jpg">
    <meta property="fb:app_id" content="362164254151266">
    <!-- facebook open graph protocol -->
    <link href="{{ webpack('build/eshopApp.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="icon" type="image/png"  href="{{ asset('images/apple-icon-60x60.png') }}">
    <style>
        html, body {
            font-family: 'Raleway', sans-serif;
            font-weight: 250;
            margin: 0;
        }
    </style>
</head>
<body>
    <div id="app">
        <eshop-navigation
                user-name="{{ \Auth::user()->name ?? '' }}"
                :categories="categories"
        ></eshop-navigation>
        <shop-header
            :setting="{{ $setting }}"
            :cart-count="{{ \Gloudemans\Shoppingcart\Facades\Cart::count() }}"
        ></shop-header>
        @yield('content')
        <shop-footer
            :setting="{{ $setting }}"
            :categories="categories"
            current-user="{{ \Auth::user() }}"
        ></shop-footer>
    </div>
    <!-- Footer End -->
    <script src="{{ webpack('build/vendor.js') }}"></script>
    <script src="{{ webpack('build/eshopApp.js') }}"></script>
    <script>
        $('.carousel').carousel({
            interval: 2000
        })
    </script>
    <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "Organization",
          "url": "http://www.estylesta.com",
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "9808476037",
            "contactType": "customer service"
          }
        }
    </script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-100719136-1', 'auto');
        ga('send', 'pageview');
    </script>
    @yield('scripts')
</body>
</html>