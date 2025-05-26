<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="{{ config('app.name') }}">
    <meta name="keywords" content="{{ config('app.name') }}">
    <meta name="author" content="{{ config('app.name') }}">
    <title>{{ config('app.name') }} | PT. Maccon Generasi Mandiri</title>

    <!-- begin:: icon -->
    <link rel="apple-touch-icon" href="{{ asset_admin('images/ico/apple-icon-120.png') }}" sizes="180x180" />
    <link rel="shortcut icon" href="{{ asset_admin('images/ico/favicon.ico') }}" type="image/x-icon" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-32x32.png') }}" type="image/x-icon" sizes="32x32" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-16x16.png') }}" type="image/x-icon" sizes="16x16" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon.ico') }}" type="image/x-icon" />
    <!-- end:: icon -->

    <!-- begin:: css global -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/themes/semi-dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/pages/page-auth.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('css/style.css') }}">
    <!-- end:: css global -->

</head>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- begin:: content -->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v2">
                    <div class="auth-inner row m-0">
                        <!-- begin:: left text -->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5" style="background-color: #1c1c1c;">
                            <div class="w-50 d-lg-flex align-items-center justify-content-center px-1">
                                <img class="img-fluid" src="{{ asset_admin('images/logo/logo.png') }}" alt="Login" />
                            </div>
                            <h1 class="fw-bolder" style="color: white;">
                                Selamat Datang <br /> di Sistem Informasi Antrean <br /> PT. Maccon Generasi Mandiri
                            </h1>
                        </div>
                        <!-- end:: left text -->

                        <!-- begin:: login -->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title fw-bold mb-1">Masuk</h2>
                                <div id="alert"></div>
                                <form class="auth-login-form mt-2" id="form-login" action="{{ route('auth.check') }}" method="post">
                                    <div class="field-input mb-1">
                                        <label class="form-label" for="username">Username</label>
                                        <input class="form-control" type="text" id="username" name="username" placeholder="Username" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="field-input mb-1">
                                        <label class="form-label" for="password">Password</label>
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Password" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="mb-1">
                                        <div class="form-check">
                                            <input class="form-check-input" id="remember" name="remember" type="checkbox" />
                                            <label class="form-check-label" for="remember">Ingat Saya!</label>
                                        </div>
                                    </div>
                                    <button type="submit" id="submit" class="btn btn-primary w-100">Masuk</button>
                                </form>
                            </div>
                        </div>
                        <!-- end:: login -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: content -->

    <!-- begin:: js global -->
    <script type="text/javascript" src="{{ asset_admin('vendors/js/vendors.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('js/core/app-menu.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('js/core/app.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('my_assets/my_fun.js') }}"></script>

    <script>
        let untukLogin = function() {
            $('#form-login').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#form-login').find('input, textarea, select').removeClass('is-valid');
                        $('#form-login').find('input, textarea, select').removeClass('is-invalid');

                        $('#submit').attr('disabled', 'disabled');
                        $('#submit').html('Waiting...');
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location = response.url;
                        } else if (response.status === 'warning') {
                            $('#alert').html(
                                `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <div class="alert-body d-flex align-items-center">
                                        <i data-feather="info" class="me-50"></i>
                                        <span>${response.message}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>`
                            );
                        } else {
                            $.each(response.errors, function(key, value) {
                                if (key) {
                                    if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
                                        $('#' + key).addClass('is-invalid');
                                        $('#' + key).parents('.field-input').find('.invalid-feedback').html(value);
                                    }
                                }
                            });
                        }

                        $('#submit').removeAttr('disabled');
                        $('#submit').html('Sign in');
                    }
                })
            });

            $(document).on('keyup', '#form-login input', function(e) {
                e.preventDefault();
                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                    $(this).parents('.field-input').find('.error').html('Kolom ini harus diisi.');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $(this).parents('.field-input').find('.error').html('');
                }
            });
        }();
    </script>
    <!-- end:: js global -->
</body>

</html>