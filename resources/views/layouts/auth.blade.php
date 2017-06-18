<!DOCTYPE html>
<html lang="en" class="fullscreen-bg">
    <head>
        <title>@yield('page_title', config('app.name', 'Laravel')) | {{ ENV('APP_NAME', 'Aplikasi Koperasi') }}</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- VENDOR CSS -->
        <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/vendor/linearicons/style.css') }}">
        <!-- MAIN CSS -->
        <link rel="stylesheet" href="{{ asset('front/assets/css/main.css') }}">
        <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
        <link rel="stylesheet" href="{{ asset('front/assets/css/demo.css') }}">
        <!-- Additional CSS -->
        <link rel="stylesheet" href="{{ asset('css/additional.css') }}">
        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!-- ICONS -->
        <link rel="apple-touch-icon" sizes="57x57" href={{ asset("img/apple-icon-57x57.png") }}>
        <link rel="apple-touch-icon" sizes="60x60" href={{ asset("img/apple-icon-60x60.png") }}>
        <link rel="apple-touch-icon" sizes="72x72" href={{ asset("img/apple-icon-72x72.png") }}>
        <link rel="apple-touch-icon" sizes="76x76" href={{ asset("img/apple-icon-76x76.png") }}>
        <link rel="apple-touch-icon" sizes="114x114" href={{ asset("img/apple-icon-114x114.png") }}>
        <link rel="apple-touch-icon" sizes="120x120" href={{ asset("img/apple-icon-120x120.png") }}>
        <link rel="apple-touch-icon" sizes="144x144" href={{ asset("img/apple-icon-144x144.png") }}>
        <link rel="apple-touch-icon" sizes="152x152" href={{ asset("img/apple-icon-152x152.png") }}>
        <link rel="apple-touch-icon" sizes="180x180" href={{ asset("img/apple-icon-180x180.png") }}>
        <link rel="icon" type="image/png" sizes="192x192"  href={{ asset("img/android-icon-192x192.png") }}>
        <link rel="icon" type="image/png" sizes="32x32" href={{ asset("img/favicon-32x32.png") }}>
        <link rel="icon" type="image/png" sizes="96x96" href={{ asset("img/favicon-96x96.png") }}>
        <link rel="icon" type="image/png" sizes="16x16" href={{ asset("img/favicon-16x16.png") }}>
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content={{ asset("img/ms-icon-144x144.png") }}>
        <meta name="theme-color" content="#ffffff">
        <!-- CSS per page -->
        @yield('css')
        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
        <!-- WRAPPER -->
        <div id="wrapper">
            <div class="vertical-align-wrap">
                <div class="vertical-align-middle">
                    <div class="auth-box ">
                        <div class="left">
                            <div class="content">
                                @yield('content')
                            </div>
                        </div>
                        <div class="right">
                            <div class="overlay"></div>
                            <div class="content text">
                                <div class="text-center logo-koperasi">
                                    <img src="{{asset('img/logo-koperasi.png')}}" width="165" alt="">
                                </div>
                                <h1 class="heading text-center">Digital Koperasi with E-Commerce</h1>
                                <p class="text-center">by <b>PT Dharmawangsa Lima Puluh</b></p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END WRAPPER -->
        <div class="wrapper-bottom-login">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="wrapper-copyright">
                            &copy 2017 Copyright. All Rights Reserved
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('javascript')
    </body>
</html>
