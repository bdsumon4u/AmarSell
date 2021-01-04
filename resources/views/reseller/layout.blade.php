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
        href="{{ asset($logo->favicon ?? '') ?? '' }}"
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
        .navbar-toggler .fa {
            color: #444;
        }
        i.fa.fa-user.r {
            font-size: 20px;
            border-radius: 10px;
            background: #efeeee;
            padding: 5px 8px;
            color: #444;
            border: 3px double red;
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
    @php $reseller = auth('reseller')->user() @endphp
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img class="navbar-brand-full" src="{{ asset($logo->white ?? '') }}" width="89" height="25" alt="Logo">
            <img class="navbar-brand-minimized" src="{{ asset($logo->favicon ?? '') }}" width="30" height="30" alt="Favicon">
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav d-md-down-none">
            
        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fa fa-user r"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>{{ $reseller->name }}</strong>
                    </div>
                    <a class="dropdown-item" href="{{ route('reseller.profile.show', auth('reseller')->user()->id) }}">
                        <i class="fa fa-user"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('reseller.logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-lock"></i> {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('reseller.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
            <span class="fa fa-question-circle fa-2x px-2"></span>
        </button>
        <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
            <span class="fa fa-question-circle fa-2x px-2"></span>
        </button>
    </header>
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
    <script>
        // window.Echo.channel(`reseller-{{ auth('reseller')->user()->id }}-notice-count`)
        //     .listen('.reseller.notice.count', function (data) {
        //         console.log(data);
        //         $('.notice-count').text(data.notice_count);
        //     });
        $(document).ready(function(){
            $(".loader").delay(1000).fadeOut("slow"); $("#overlayer").delay(1000).fadeOut("slow");
        });
    </script>
</body>

</html>