<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <!-- begin:: brand -->
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="#">
                    <h2 class="brand-text">ANTREAN</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle" style="color: #000;">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
            <!-- end:: brand -->
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : ''  }}">
                <a class="d-flex align-items-center" href="{{ route('admin.dashboard.index') }}">
                    <i data-feather="home"></i><span class="menu-title text-truncate">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="list"></i><span class="menu-title text-truncate">Master Produk</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('admin.satuan.index') }}">
                            <i data-feather="tag"></i><span class="menu-item text-truncate">Satuan</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('admin.produk.index') }}">
                            <i data-feather="package"></i><span class="menu-item text-truncate">Produk</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="list"></i><span class="menu-title text-truncate">Master Antrean</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('admin.kendaraan.index') }}">
                            <i data-feather="truck"></i><span class="menu-item text-truncate">Kendaraan</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('admin.metode.index') }}">
                            <i data-feather="settings"></i><span class="menu-item text-truncate">Metode</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="navigation-header">
                <span>Proses Antrean</span><i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item {{ request()->is('admin/pendaftaran') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.pendaftaran.index') }}">
                    <i data-feather="edit-3"></i><span class="menu-title text-truncate">Pendaftaran</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('admin/antrean') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.antrean.index') }}">
                    <i data-feather="clock"></i><span class="menu-title text-truncate">Antrean</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('admin/display') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.display.index') }}" target="_blank">
                    <i data-feather="monitor"></i><span class="menu-title text-truncate">Display</span>
                </a>
            </li>

        </ul>
    </div>
</div>