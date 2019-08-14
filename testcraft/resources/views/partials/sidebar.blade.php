@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('admin.ca_dashboard')</span>
                </a>
            </li>
            
            <!-- @can('user_management_access') -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('admin.user-management')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                <!-- @can('role_access') -->
                <li class="{{ $request->segment(2) == 'userTypes' ? 'active active-sub' : '' }}">
                    <a href="">
                        <i class="fa fa-briefcase"></i>
                        <span class="title">
                            @lang('admin.user_types.title')
                        </span>
                    </a>
                </li>
                <!-- @endcan
                @can('user_access') -->
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                    <a href="">
                        <i class="fa fa-user"></i>
                        <span class="title">
                            @lang('admin.users.title')
                        </span>
                    </a>
                </li>
                <!-- @endcan -->
                </ul>
            </li>
            <!-- @endcan -->

            <!-- <li class="{{ $request->segment(1) == 'tutors' ? 'active' : '' }}">
                <a href="{{ route('tutors.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">@lang('admin.tutors.title')</span>
                </a>
            </li> -->

            @if (Auth::guard('admin')->check())

            <li class="{{ $request->segment(1) == 'courseTypes' ? 'active' : '' }}">
                <a href="{{ route('courseTypes.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">@lang('admin.course_types.title')</span>
                </a>
            </li>

            <li class="{{ $request->segment(1) == 'boards' ? 'active' : '' }}">
                <a href="{{ route('boards.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">@lang('admin.boards.title')</span>
                </a>
            </li>

            <li class="{{ $request->segment(1) == 'standards' ? 'active' : '' }}">
                <a href="{{ route('standards.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">@lang('admin.standards.title')</span>
                </a>
            </li>

            <li class="{{ $request->segment(1) == 'subjects' ? 'active' : '' }}">
                <a href="{{ route('subjects.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">@lang('admin.subjects.title')</span>
                </a>
            </li>

            <li class="{{ $request->segment(1) == 'courses' ? 'active' : '' }}">
                <a href="{{ route('courses.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">@lang('admin.courses.title')</span>
                </a>
            </li>

            <li class="{{ $request->segment(1) == 'testTypes' ? 'active' : '' }}">
                <a href="{{ route('testTypes.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">@lang('admin.test_types.title')</span>
                </a>
            </li>

            <li class="{{ $request->segment(1) == 'courseSubjects' ? 'active' : '' }}">
                <a href="{{ route('courseSubjects.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">@lang('admin.course_subjects.title')</span>
                </a>
            </li>

            <li class="{{ $request->segment(1) == 'boardStandardSubjects' ? 'active' : '' }}">
                <a href="{{ route('boardStandardSubjects.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">@lang('admin.board_standard_subjects.title')</span>
                </a>
            </li>

            @endif

            @if (Auth::guard('tutor')->check())

            <li class="{{ $request->segment(1) == 'testPackages' ? 'active' : '' }}">
                <a href="{{ route('testPackages.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">@lang('admin.test_packages.title')</span>
                </a>
            </li>

            <li class="{{ $request->segment(1) == 'questions' ? 'active' : '' }}">
                <a href="{{ route('questions.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">@lang('admin.questions.title')</span>
                </a>
            </li>

            @endif

            <!-- <li class="{{ $request->segment(1) == 'units' ? 'active' : '' }}">
                <a href="{{ route('units.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">@lang('admin.units.title')</span>
                </a>
            </li> -->

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('admin.ca_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('admin.ca_logout')</span>
                </a>
            </li>

        </ul>
    </section>
</aside>

