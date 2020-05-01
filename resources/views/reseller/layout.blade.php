<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/coreui.css') }}" rel="stylesheet">
    <style>
        .nav-dropdown-items .nav-link {
            padding-left: 5px !important;
        }
    </style>
    @yield('styles')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <x-layouts.header provider="reseller" />
    <div class="app-body">
        <x-layouts.sidebar :menu="$menu" />
        <main class="main mt-3">
            <!-- Breadcrumb-->
            <div class="container-fluid">
                <div class="animated fadeIn">
                    @if($message = Session::get('success'))
                    <div class="alert alert-success py-2"><strong>{{ $message }}</strong></div>
                    @endif
                    @if($message = Session::get('error'))
                    <div class="alert alert-danger py-2"><strong>{{ $message }}</strong></div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </main>
        <x-layouts.aside :asideTab="$asideTab" />
    </div>
    <x-layouts.footer />
    <script src="{{ asset('js/coreui.js') }}"></script>
    @yield('scripts')
</body>

</html>