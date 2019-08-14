<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')

<!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
    <link href="{{ asset('vendors/front-bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<!--===============================================================================================-->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<!--===============================================================================================-->
    <link href="{{ asset('fonts/elegant-font/html-css/style.css') }}" rel="stylesheet">
<!--===============================================================================================-->
    <link href="{{ asset('vendors/animsition/css/animsition.min.css') }}" rel="stylesheet">
<!--===============================================================================================-->
    <link href="{{asset('vendors/slick/slick.css')}}" rel="stylesheet">
<!--===============================================================================================-->
    <link href="{{asset('css/util.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    @yield('css')

</head>
<body class="animsition">

    <!-- Header -->
    <header class="header1">
        <!-- Header desktop -->
        <div class="container-menu-header">
            <div class="wrap_header">
                <!-- Logo -->
                <a href="{{route('front_home')}}" class="logo">
                    <img src="{{ asset('images/icons/logox40.png')}}" alt="IMG-LOGO" class="logo-height">
                </a>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap_header_mobile wrap_header">
            <!-- Logo moblie -->
            <a href="{{route('front_home')}}" class="logo-mobile">
                <img src="{{asset('images/icons/logox40.png')}}" alt="IMG-LOGO" class="logo-height">
            </a>
        </div>

        <!-- Menu Mobile -->
        @yield('mobile_menu')

    </header>
    
    <div id='ajax_loader' class="ajax_loader">
        <img src="{{ asset('images/icons/ajax-loader.gif') }}"></img>
    </div>

    <!-- page content -->
    @yield('content')
    <!-- /page content -->

    <!-- Footer -->
    <footer class="bg6 p-b-10 p-l-45 p-r-45">
        <div class="t-center p-l-15 p-r-15">
            <div class="t-center s-text8 p-t-20">
                Copyrights © 2018 & All Rights Reserved by Flinnt.com.
            </div>
        </div>
    </footer>

    <!-- Back to top -->
    <div class="btn-back-to-top bg0-hov" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </span>
    </div>

<!--===============================================================================================-->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('vendors/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('vendors/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('vendors/front-bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{asset('vendors/slick/slick.min.js')}}"></script>
    <script src="{{asset('js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('js/main.js')}}"></script>

    @yield('script')

</body>
</html>