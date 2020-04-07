<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        Shop
        - FleetCart
    </title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script>
        window.FleetCart = {
            csrfToken: '{{ csrf_token() }}',
            langs: {
                'storefront::products.loading': '{{ trans("storefront::products.loading") }}',
            },
        };
    </script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Rubik:400,500" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://fleetcart.envaysoft.com/themes/storefront/public/css/app.css?v=1.1.9">
    <!-- <link rel="stylesheet" href="{{ asset('css/shop.css') }}"> -->
    <link rel="shortcut icon"
        href="https://fleetcart.envaysoft.com/storage/media/w2VuVc7ASHg8KeYCTJWDpLYZu0RjsivUCg4fTN2i.png"
        type="image/x-icon">
    <style>
        .mini-cart-title a {
            text-decoration: none;
        }
        .search-area .mobile-search .dropdown-menu {
            min-width: 280px;
        }
        .category-menu-wrapper.show .fa-angle-down {
            transform: rotate(180deg);
        }
        @media screen and (min-width: 681px)
        {
            .product-list-result .grid-products .product-card:nth-child(-n+4) {
                margin-top: 20px;
            }
        }
        @media screen and (min-width: 991px)
        {
            .product-list-result .grid-products {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        .product-card .image-holder,
        .product-card .image-placeholder {
            border: 2px solid #ddd;
        }
    </style>
    @yield('styles')
</head>

<body class="theme-navy-blue slider_with_banners ltr">
    <!--[if lt IE 8]>
            <p>You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="main">
        <div class="wrapper">
            @include('resellers.shop.inc.sidebar')
            @include('resellers.shop.inc.topbar')
            @include('resellers.shop.inc.header')
            
            @include('resellers.shop.partials.mega-menu')

            <div class="content-wrapper clearfix ">
                <div class="container">
                    
                    @unless (request()->routeIs('home') || request()->routeIs('login') || request()->routeIs('register') || request()->routeIs('reset') || request()->routeIs('reset.complete'))
                        @include('resellers.shop.partials.notification')
                    @endunless

                    @yield('content')

                </div>
            </div>


            @include('resellers.shop.inc.footer')

            <a class="scroll-top" href="#">
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </a>

        </div>

        <div class="modal fade" id="quick-view-modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body clearfix">
                        Loading...
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
    <!-- <script src="https://fleetcart.envaysoft.com/themes/storefront/public/js/app.js?v=1.1.9"></script> -->
    <script src="{{ asset('js/fleetcart.js') }}"></script>
    @yield('scripts')
</body>

</html>