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
    <link rel="shortcut icon"
        href="{{ asset($logo->favicon) ?? '' }}"
        type="image/x-icon">
    <style>
        #overlayer {
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 7100;
            background: #fff;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
        .loader {
            z-index: 7700;
            position: fixed;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        .nav-dropdown-items .nav-link {
            padding-left: 5px !important;
        }
        i.fa.fa-user.r {
            font-size: 20px;
            border-radius: 10px;
            background: #efeeee;
            padding: 5px 8px;
            color: #444;
            border: 3px double red;
        }
        label {
            font-weight: bold;
            font-family: cursive, monospace;
            font-size: 14px;
        }
        #base-setting .form-group {
            padding: 2px 3px;
            border: 1px solid #ddd;
        }
    </style>
    @yield('styles')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <x-layouts.header />
    <div class="app-body" id="app">
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
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".loader").delay(1000).fadeOut("slow"); $("#overlayer").delay(1000).fadeOut("slow");

            $('#color-logo, #white-logo, #footer-logo, #favicon-logo').change(function(e){
                console.log('changed')
                renderLogo(this);
            });

            function renderLogo(input) {
                console.log('rendering')
                if(input.files.length) {
                    console.log('has length')
                    var reader = new FileReader;
                    reader.readAsDataURL(input.files[0]);
                    reader.onload = function(e) {
                        console.log('onload')
                        $(input).next('img').show().attr('src', e.target.result);
                    }
                }
            }
        });
    </script>
</body>

</html>