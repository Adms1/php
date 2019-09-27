<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>
    <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon" />
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('adminlte/plugins/jQueryUI/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('adminlte/css/custom.css') }}" rel="stylesheet">
    <style type="text/css">
        body {
            background: #e9f7ff;
        }
        .container {
            max-width: 100% !important;
        }
        .m-l-5 {
            margin-left: 5px;
        }
        .p-10 {
            padding: 10px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" stylelogo_pdf="max-width:300px;">
                </a>
                <!-- @if (Request::segment(1) == 'tutor')
                    <a class="navbar-brand" href="{{ route('admin_login') }}">
                        @lang('admin.ca_title')
                    </a>
                @endif -->
                @if (Request::segment(1) == 'admin')
                    <a class="navbar-brand" href="{{ route('tutor_login') }}">
                        @lang('admin.ca_tutor')
                    </a>
                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @if (Request::segment(1) == 'tutor')
                            <!-- Authentication Links -->
                            <li class="nav-item">
                                    <a class="btn btn-primary" href="{{ Config::get('settings.WEB_URL') }}">{{ __('Home') }}</a>
                                </li>
                            @if (Request::segment(2) == 'login')
                                <li class="nav-item">
                                    <a class="btn btn-primary m-l-5" href="{{ route('tutor_register') }}">{{ __('Sign Up') }}</a>
                                </li>
                            @else 
                                <li class="nav-item">
                                    <a class="btn btn-primary m-l-5" href="{{ route('tutor_login') }}">{{ __('Sign In') }}</a>
                                </li>
                            @endif 
                        @endif
                        <!-- @if (Request::segment(1) == 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin_login') }}">{{ __('Login') }}</a>
                            </li>

                            @if (Route::has('admin_register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin_register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @endif -->
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ url('quickadmin/js/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ url('quickadmin/js/jquery-ui.min.js') }}"></script>
    <script src="{{ url('quickadmin/js/parsley.min.js') }}"></script>
    @yield('javascript')
</body>
</html>