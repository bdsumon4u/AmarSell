<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>imagine &mdash; Onepage Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <style>
        .footer ul {
            margin-bottom: 0;
        }
        .footer ul li {
            display: inline-block;
            margin-left: 10px;
            margin-right: 10px;
        }
        .footer ul li i {
            font-size: 20px;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="site-wrap" id="home-section">
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle">&times;</span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>
        <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6 col-md-3 col-xl-4  d-block">
                        <h1 class="mb-0 site-logo"><a href="index.html" class="text-black h2 mb-0">
                            <img src="{{ asset($logo->white) ?? '' }}" alt="Logo" style="height: 50px; width: 240px;">
                        </h1>
                    </div>
                    <div class="col-12 col-md-9 col-xl-8 main-menu">
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block ml-0 pl-0">
                                <li><a href="#home-section" class="nav-link">Home</a></li>
                                <li><a href="#login-section" class="nav-link">Login</a></li>
                                <li><a href="#features-section" class="nav-link">Features</a></li>
                                <li><a href="#testimonials-section" class="nav-link">Testimonials</a></li>
                                <li><a href="#become-reseller" class="nav-link">Become a Reseller</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-6 col-md-9 d-inline-block d-lg-none ml-md-0"><a href="#"
                            class="site-menu-toggle js-menu-toggle text-black float-right"><span
                                class="fa fa-bars"></span></a></div>
                </div>
            </div>
        </header>
        @yield('content')
        <div class="footer py-5 text-center">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-12">
                        {!! iconMenu('iconsocial') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="mb-0">
                            <span class="float-right d-inline w-100">Developed By<a href="https://cyber32.com" class="text-danger">&nbsp;Cyber32</a></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js"></script>
    <script src="{{ asset('js/landing.js') }}"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js"></script>
</body>

</html>