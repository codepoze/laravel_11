<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="Sistem Informasi Sekolah {{ config('app.name') }}">
    <meta name="keywords" content="Sistem Informasi Sekolah {{ config('app.name') }}">
    <meta name="author" content="Sistem Informasi Sekolah {{ config('app.name') }}">
    <title>{{ config('app.name') }} | 503</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- begin:: icon -->
    <link rel="apple-touch-icon" href="{{ asset_admin('images/icon/apple-touch-icon.png') }}" sizes="180x180" />
    <link rel="shortcut icon" href="{{ asset_admin('images/icon/favicon.ico') }}" type="image/x-icon" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon.ico') }}" type="image/x-icon" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-32x32.png') }}" type="image/x-icon" sizes="32x32" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-16x16.png') }}" type="image/x-icon" sizes="16x16" />
    <!-- end:: icon -->

    <!-- begin:: css local -->
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/vendors.min.css') }}">
    @yield('css')
    <!-- end:: css local -->

    <!-- begin:: css global -->
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/themes/semi-dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/pages/page-misc.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('my_assets/my_css.css') }}">
    <!-- end:: css global -->

    <script src="{{ asset_admin('vendors/js/vendors.min.js') }}"></script>
</head>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="misc-wrapper">
                    <div class="misc-inner p-2 p-sm-3">
                        <div class="w-100 text-center">
                            <h2 class="mb-1">Under Maintenance 🛠</h2>
                            <p class="mb-3">
                                Sorry for the inconvenience but we're performing some maintenance at the moment
                            </p>
                            <img class="img-fluid" src="{{ asset_admin('images/pages/under-maintenance.svg') }}" alt="Error page" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- begin:: js global -->
    <script type="text/javascript" src="{{ asset_admin('js/core/app-menu.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('js/core/app.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('my_assets/my_fun.js') }}"></script>

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
    <!-- end:: js global -->
</body>

</html>