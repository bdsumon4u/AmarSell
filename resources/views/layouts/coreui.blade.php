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
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <x-layouts.header />
    <div class="app-body">
        <x-layouts.sidebar />
        <main class="main">
            <!-- Breadcrumb-->
            <x-layouts.breadcrumb />
            <div class="container-fluid">
                <div class="animated fadeIn">
                    @yield('content')
                </div>
            </div>
        </main>
        <x-layouts.aside />
    </div>
    <x-layouts.footer />
    <script src="{{ asset('js/coreui.js') }}"></script>
</body>

</html>