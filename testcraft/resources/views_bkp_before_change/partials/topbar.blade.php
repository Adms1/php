<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/admin/home') }}" class="logo font-16">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <img src="{{ asset('images/logo-mini.png') }}" class="width-50">
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <img src="{{ asset('images/logo.png') }}" stylelogo_pdf="max-width:300px;">
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="pull-right p-r-10" >
            <ul class="nav navbar-right top-nav pull-right">
                <li>
                    <a href="#" data-toggle="dropdown" title="Name" aria-expanded="true">
                        <img src="{{ asset('images/profile_photo.png') }}" id="imgprofile" alt="user_profile" class="user-auth-img img-circle width-30">
                    </a>
                    <ul class="dropdown-menu user-auth-dropdown p-10" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                        <li class="text-center">
                            @if (Auth::guard('admin')->check())
                                <span><b>{{Auth::guard('admin')->user()->UserFullName}}</b></span><br>
                                <span class="txt-grey">{{Auth::guard('admin')->user()->UserEmail}}</span>
                            @endif
                            @if (Auth::guard('tutor')->check())
                                <span><b>{{Auth::guard('tutor')->user()->TutorName}}</b></span><br>
                                <span class="txt-grey">{{Auth::guard('tutor')->user()->TutorEmail}}</span>
                            @endif
                        </li>
                        <li class="divider"></li>
                        <li>
                            @if (Auth::guard('admin')->check())
                                <a href="{{route('admin_profile')}}"><i class="fa fa-user"></i><span>Profile</span></a>
                            @endif
                            @if (Auth::guard('tutor')->check())
                                <a href="{{route('tutor_profile')}}"><i class="fa fa-user"></i><span>Profile</span></a>
                            @endif
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#logout" onclick="$('#logout').submit();">
                                <i class="fa fa-arrow-left"></i>
                                <span class="title">@lang('admin.ca_logout')</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>