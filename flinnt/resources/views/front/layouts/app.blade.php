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
    <link href="{{ asset('fonts/themify/themify-icons.css') }}" rel="stylesheet">
<!--===============================================================================================-->
    <link href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}" rel="stylesheet">
<!--===============================================================================================-->
    <link href="{{ asset('fonts/elegant-font/html-css/style.css') }}" rel="stylesheet">
<!--===============================================================================================-->
    <!-- <link href="{{ asset('vendors/animate.css/animate.min.css') }}" rel="stylesheet"> -->
<!--===============================================================================================-->
    <link href="{{ asset('vendors/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet">
<!--===============================================================================================-->
    <link href="{{ asset('vendors/animsition/css/animsition.min.css') }}" rel="stylesheet">
<!--===============================================================================================-->
    <link href="{{asset('vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
<!--===============================================================================================-->
    <link href="{{asset('vendors/slick/slick.css')}}" rel="stylesheet">
<!--===============================================================================================-->
    <link href="{{asset('vendors/noui/nouislider.min.css')}}" rel="stylesheet">
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
            <div class="topbar">
            </div>

            <div class="wrap_header">
                <!-- Logo -->
                <a href="{{route('front_home')}}" class="logo">
                    <img src="{{ asset('images/icons/logox40.png')}}" alt="IMG-LOGO" class="logo-height">
                </a>

                <!-- Menu -->
                <div class="wrap_menu">
                    <nav class="menu">
                    </nav>
                </div>

                <!-- Header Icon -->
                @if (Auth::guard('user')->check()) 
                <div class="header-icons">
                    <!-- <img src="{{asset('images/icons/icon-header-01.png')}}" class="header-icon1 dropdown" alt="ICON">
                    <div class="header-cart dropdown-content">
                        <ul class="header-cart-wrapitem">
                            <li class="header-cart-item">
                                <a href="{{route('user_profile')}}"><i class="fa fa fa-user"> </i> Profile</a>
                            </li>
                            <li class="header-cart-item">
                                <a href="{{route('user_order')}}"><i class="fa fa fa-wpforms"> </i> Order List</a>
                            </li>
                            <li class="header-cart-item">
                                <a href="{{route('user_logout')}}"><i class="fa fa fa-sign-out"> </i> Logout</a>
                            </li>
                        </ul>
                    </div> -->

                    <img src="{{asset('images/icons/icon-header-01.png')}}" class="header-icon1" alt="ICON">
                    <div class="dropdown">
                      <button class="dropbtn">Hi, {{Auth::guard('user')->user()->user_name}}
                        <i class="fa fa-angle-down"></i>
                        </button>
                      <div class="dropdown-content">
                        <a href="{{route('user_profile')}}"><i class="fa fa fa-user"> </i> Profile</a>
                        <a href="{{route('user_order')}}"><i class="fa fa fa-wpforms"> </i> Order List</a>
                        <a href="{{route('user_logout')}}"><i class="fa fa fa-sign-out"> </i> Logout</a>
                      </div>
                    </div>

                    <span class="header-slice"></span>

                    <a href="{{route('front_home')}}" class="header-wrapicon1 dis-block">
                        <img src="{{asset('images/icons/home.png')}}" class="header-icon1" alt="ICON">
                        <span class="white-color">Home</span>
                    </a>

                    <span class="header-slice"></span>

                    <a href="#" class="header-wrapicon1 dis-block">
                        <img src="{{asset('images/icons/flinnt_book_final.png')}}" class="header-icon1" alt="ICON">
                        <span class="header-icons-noti bg-color">40</span>
                    </a>

                    <span class="m-r-23"></span>
                    <div class="shopping-cart-header">
                        <div class="header-wrapicon2">
                            <img src="{{asset('images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                            <span class="header-icons-noti bg-color">
                            @if (Auth::guard('user')->check()) 
                                {{Cart::instance('cartlist')->count()}}
                            @endif
                            </span>

                            <!-- Header cart noti -->
                            <div class="header-cart header-dropdown">
                                <ul class="header-cart-wrapitem">
                                    @foreach (Cart::instance('cartlist')->content() as $cart)
                                    <li class="header-cart-item">
                                        <div class="header-cart-item-img">
                                            <img src="{{URL::asset('/'.$cart->options->image)}}" alt="IMG">
                                        </div>

                                        <div class="header-cart-item-txt">
                                            <a href="#" class="header-cart-item-name m-text14">
                                                {{ $cart->name }}
                                            </a>

                                            <span class="header-cart-item-info m-text14">
                                                {{ $cart->qty }} x <i class="fa fa-rupee"></i> {{ $cart->price }}
                                            </span>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>

                                <div class="header-cart-total m-text14">
                                    Total: <i class="fa fa-rupee"></i> {{Cart::subtotal()}}
                                </div>

                                <div class="header-cart-buttons">
                                    <div class="header-cart-wrapbtn">
                                        <!-- Button -->
                                        <a href="{{ url('/cart') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                            View Cart
                                        </a>
                                    </div>

                                    @if (Cart::instance('cartlist')->count() > 0)
                                    <div class="header-cart-wrapbtn">
                                        <!-- Button -->
                                        <a href="{{ route('select_address') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                            Check Out
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="header-icons">
                    <a href="{{Config::get('settings.APP_URL')}}" class="btn flinnt-btn border-white">Login</a>
                </div>
                @endif
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap_header_mobile wrap_header">
            <!-- Logo moblie -->
            <a href="{{route('front_home')}}" class="logo-mobile">
                <img src="{{asset('images/icons/logox40.png')}}" alt="IMG-LOGO" class="logo-height">
            </a>

            <!-- Button show menu -->
            <div class="btn-show-menu">
                <!-- Header Icon mobile -->
                @if (Auth::guard('user')->check()) 
                <div class="header-icons-mobile">
                    
                    <div class="dropdown">
                        <img src="{{asset('images/icons/icon-header-01.png')}}" class="header-icon1 dropbtn" alt="ICON">
                        <div class="dropdown-content">
                            <a href="#">Hi, {{Auth::guard('user')->user()->user_name}}</a>
                            <a href="{{route('user_profile')}}"><i class="fa fa fa-user"> </i> Profile</a>
                            <a href="{{route('user_order')}}"><i class="fa fa fa-wpforms"> </i> Order List</a>
                            <a href="{{route('user_logout')}}"><i class="fa fa fa-sign-out"> </i> Logout</a>
                        </div>
                    </div>

                    <span class="m-r-23"></span>

                    <a href="#" class="header-wrapicon1 dis-block">
                        <img src="{{asset('images/icons/flinnt_book_final.png')}}" class="header-icon1" alt="ICON">
                    </a>

                    <span class="m-r-23"></span>

                    <div class="shopping-cart-header">
                        <div class="header-wrapicon2">
                            <img src="{{asset('images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                            <span class="header-icons-noti bg-color">{{Cart::instance('cartlist')->count()}}</span>

                            <!-- Header cart noti -->
                            <div class="header-cart header-dropdown">
                                <ul class="header-cart-wrapitem">
                                    @foreach (Cart::instance('cartlist')->content() as $cart)
                                    <li class="header-cart-item">
                                        <div class="header-cart-item-img">
                                            <img src="{{URL::asset('/'.$cart->options->image)}}" alt="IMG">
                                        </div>

                                        <div class="header-cart-item-txt">
                                            <a href="#" class="header-cart-item-name m-text14">
                                                {{ $cart->name }}
                                            </a>

                                            <span class="header-cart-item-info m-text14">
                                                {{ $cart->qty }} x <i class="fa fa-rupee"></i> {{ $cart->price }}
                                            </span>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>

                                <div class="header-cart-total m-text14">
                                    Total: <i class="fa fa-rupee"></i>{{Cart::subtotal()}}
                                </div>

                                <div class="header-cart-buttons">
                                    <div class="header-cart-wrapbtn">
                                        <!-- Button -->
                                        <a href="{{ url('/cart') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                            View Cart
                                        </a>
                                    </div>

                                    @if (Cart::instance('cartlist')->count() > 0)
                                    <div class="header-cart-wrapbtn">
                                        <!-- Button -->
                                        <a href="{{ route('select_address') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                            Check Out
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="header-icons-mobile">
                    <a href="{{Config::get('settings.APP_URL')}}" class="btn flinnt-btn border-white">Login</a>
                </div>
                @endif

                <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </div>
            </div>
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

    <!-- show institution validate notification modal -->
    <div class="modal fade show-notification" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notification">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p>{{'Please select institution and update your profile first.'}}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="notification_close" data-dismiss="modal">Close</button>
                    <button type="button" onclick="location.href = '{{route("user_profile")}}'" id="notification_submit" class="btn btn-primary">Update Now</button>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Container Selection -->
    <div id="dropDownSelect1"></div>
    <div id="dropDownSelect2"></div>

<!--===============================================================================================-->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('vendors/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('vendors/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('vendors/front-bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(".selection-1").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect1')
        });

        $(".selection-2").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect2')
        });
    </script>
<!--===============================================================================================-->
    <script src="{{asset('vendors/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('vendors/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('vendors/slick/slick.min.js')}}"></script>
    <script src="{{asset('js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
    <script type="text/javascript">
        // $('.block2-btn-addcart').each(function(){
        //     var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        //     $(this).on('click', function(){
        //         swal(nameProduct, "is added to cart !", "success");
        //     });
        // });

        // $('.block2-btn-addwishlist').each(function(){
        //     var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        //     $(this).on('click', function(){
        //         swal(nameProduct, "is added to wishlist !", "success");
        //     });
        // });

        // $('.btn-addcart-product-detail').each(function(){
        //     var nameProduct = $('.product-detail-name').html();
        //     $(this).on('click', function(){
        //         swal(nameProduct, "is added to cart !", "success");
        //     });
        // });
    </script>

<!--===============================================================================================-->
    <script src="{{asset('vendors/noui/nouislider.min.js')}}"></script>
    <script type="text/javascript">
        /*[ No ui ]
        ===========================================================*/
        var filterBar = document.getElementById('filter-bar');
        if (filterBar != null) {
            noUiSlider.create(filterBar, {
                start: [ 50, 200 ],
                connect: true,
                range: {
                    'min': 50,
                    'max': 200
                }
            });

            var skipValues = [
                document.getElementById('value-lower'),
                document.getElementById('value-upper')
            ];

            filterBar.noUiSlider.on('update', function( values, handle ) {
                skipValues[handle].innerHTML = Math.round(values[handle]) ;
            });
        }

        var mobilefilterBar = document.getElementById('mobile-filter-bar');
        if (mobilefilterBar != null) {
            noUiSlider.create(mobilefilterBar, {
                start: [ 50, 200 ],
                connect: true,
                range: {
                    'min': 50,
                    'max': 200
                }
            });

            var mobileSkipValues = [
                document.getElementById('mobile-value-lower'),
                document.getElementById('mobile-value-upper')
            ];

            mobilefilterBar.noUiSlider.on('update', function( values, handle ) {
                mobileSkipValues[handle].innerHTML = Math.round(values[handle]) ;
            });
        }
    </script>
<!--===============================================================================================-->
    <script src="{{asset('js/main.js')}}"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            // Add and remove border related class in filter sidebar
            if($(window).width() >= 992){
                $('#mobile-filter-men').removeClass('mobile-test');
                $('#mobile-filter-men').css('display','block');
            } else {
                $('#mobile-filter-men').addClass('mobile-test');
                $('#mobile-filter-men').css('display','none');
            }
            
            $(window).resize(function(){
                if($(window).width() >= 992){
                    $('#mobile-filter-men').removeClass('mobile-test');
                    $('#mobile-filter-men').css('display','block');
                } else {
                    $('#mobile-filter-men').addClass('mobile-test');
                    $('#mobile-filter-men').css('display','none');
                }
            });

        });
    </script>

    @yield('script')

</body>
</html>