<!DOCTYPE html>
<html lang="en">
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
        <link rel="stylesheet" href="{{ asset('front/assets/vendor/toastr/toastr.min.css') }}">
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
            <!-- NAVBAR -->
            @include('partials.app-navbar')
            <!-- END NAVBAR -->
            <!-- LEFT SIDEBAR -->
            @include('partials.app-sidebar')
            <!-- END LEFT SIDEBAR -->
            <!-- MAIN produk -->
            <div class="main">
                <!-- MAIN CONTENT -->
                <div class="main-content">
                    <div class="container-fluid">
                        @yield('page_header')
                        @include('flash::message')
                        @yield('content')
                    </div>
                </div>
                <!-- END MAIN CONTENT -->
            </div>
            <!-- END MAIN -->
            <div class="clearfix"></div>
            <footer>
                <div class="container-fluid">
                    <p class="copyright">&copy; 2017 <a href="https://www.sintesa.co.id" target="_blank">PT Dharmawangsa Lima Puluh</a>. All Rights Reserved.</p>
                </div>
            </footer>
        </div>
        <!-- END WRAPPER -->
        <!-- Javascript -->
        <script src="{{ asset('front/assets/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('front/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('front/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('front/assets/vendor/toastr/toastr.min.js') }}"></script>
        <script src="{{ asset('front/assets/scripts/klorofil-common.js') }}"></script>
        @include('partials.app-script')
        <!-- Javascript per page -->
        @stack('scripts')
    </body>
</html>
