<header class="app-header navbar">
    @php $admin = auth()->user() @endphp
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="{{ asset($logo->white ?? '') ?? '' }}" width="89" height="25" alt="Logo">
        <img class="navbar-brand-minimized" src="{{ asset($logo->favicon ?? '') ?? '' }}" width="30" height="30" alt="Favicon">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="{{ route('admin.resellers.index') }}">Resellers</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="{{ route('admin.settings.edit') }}">Settings</a>
        </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <i class="fa fa-user r"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>{{ $admin->name }}</strong>
                </div>
                <a class="dropdown-item" href="{{ route('admin.settings.edit') }}">
                    <i class="fa fa-wrench"></i> Settings</a>
                <!-- <a class="dropdown-item" href="{{ route('admin.transactions.requests') }}">
                    <i class="fa fa-usd"></i> Payment Requests
                    <span class="badge badge-secondary"></span>
                </a> -->
                <a class="dropdown-item" href="{{ route($provider == 'users' ? 'logout' : $provider.'.logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route($provider == 'users' ? 'logout' : $provider.'.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
    <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
        <span class="fa fa-info-circle fa-2x px-2"></span>
    </button>
    <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
        <span class="fa fa-info-circle fa-2x px-2"></span>
    </button>
</header>