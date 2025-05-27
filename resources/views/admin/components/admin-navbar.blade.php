<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <!-- begin:: left -->
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
        </div>
        <!-- end:: left -->
        <!-- begin:: right -->
        <ul class="nav navbar-nav align-items-center ms-auto">
            <!-- begin:: profil & settings -->
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">{{ Auth::user()->name }}</span>
                        <span class="user-status">{{ ucfirst(Auth::user()->roles->pluck('name')[0]) }}</span>
                    </div>
                    <span class="avatar">
                        <img class="round" src="{{ (Auth::user()->foto === null) ? '//placehold.co/150' : asset_upload('picture/akun/'.Auth::user()->foto) }}" alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ route('admin.akun.index') }}">
                        <i class="me-50" data-feather="user"></i>Akun
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('auth.logout') }}">
                        <i class="me-50" data-feather="power"></i> Keluar
                    </a>
                </div>
            </li>
            <!-- begin:: profil & settings -->
        </ul>
        <!-- end:: right -->
    </div>
</nav>