<div class="page-sidebar">
    <a class="logo-box" href="{{route('dashboard.index')}}">
        <span><img src="{{asset("assets/images/logo-white.png")}}" alt=""></span>
        <i class="ion-aperture" id="fixed-sidebar-toggle-button"></i>
        <i class="ion-ios-close-empty" id="sidebar-toggle-button-close"></i>
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                <li @if(request()->routeIs('dashboard.*')) class="active" @endif>
                    <a href="{{route('dashboard.index')}}"><i class="fa fa-tachometer"></i><span>{{__('form.dashboard')}}</span></a>
                </li>
                @canany(['roles.index','permissions.index','users.index', 'languages.index'])
                    <li class="@if(request()->routeIs('roles.*','permissions.*','users.*')) active open @endif">
                        <a href="javascript:void(0);"><i class="fa fa-cogs"></i>
                            <span>{{__('form.settings')}}</span><i class="accordion-icon fa fa-angle-left"></i></a>
                        <ul class="sub-menu" style="display:block">
                            @can('users.index')
                                <li @if(request()->routeIs('users.*')) class="active" @endif >
                                    <a href="{{ route('users.index') }}"><i class="fa fa-user"></i>{{__('form.users.users')}}</a>
                                </li>
                            @endcan
                            @can('roles.index')
                                <li @if(request()->routeIs('roles.*')) class="active" @endif>
                                    <a href="{{ route('roles.index') }}"><i class="fa fa-shield"></i>{{__('form.roles.roles')}}</a>
                                </li>
                            @endcan
                            @can('permissions.index')
                                <li @if(request()->routeIs('permissions.*')) class="active" @endif>
                                    <a href="{{ route(('permissions.index')) }}"><i class="fa fa-unlock"></i>{{__('form.permissions.permissions')}}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                <li>
                    <a href="javascript:void(0);"><i class="fa fa-clone"></i>
                        <span>Layouts</span><i class="accordion-icon fa fa-angle-left"></i></a>
                    <ul class="sub-menu">
                        <li><a href="layout-blank.html">Blank Page</a></li>
                        <li><a href="layout-collapsed-sidebar.html">Collapsed Sidebar</a></li>
                    </ul>
                </li>
                <li class="menu-divider mg-y-20-force"></li>
            </ul>
        </div>
    </div>
    <!--================================-->
    <!-- Sidebar Footer Start -->
    <!--================================-->
    <div class="sidebar-footer">
        <a class="pull-left" href="page-profile.html" data-toggle="tooltip" data-placement="top"
           data-original-title="Profile">
            <i class="icon-user"></i></a>
        <a class="pull-left " href="mailbox.html" data-toggle="tooltip" data-placement="top"
           data-original-title="Mailbox">
            <i class="icon-envelope"></i></a>
        <a class="pull-left" href="page-unlock.html" data-toggle="tooltip" data-placement="top"
           data-original-title="Lockscreen">
            <i class="icon-lock"></i></a>
        <a class="pull-left" href="page-singin.html" data-toggle="tooltip" data-placement="top"
           data-original-title="Sing Out">
            <i class="icon-power"></i></a>
    </div>
    <!--/ Sidebar Footer End -->
</div>
