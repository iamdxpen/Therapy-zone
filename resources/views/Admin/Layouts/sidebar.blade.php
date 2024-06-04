<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Light Logo-->
        <a href="{{route('admin.dashboard')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{get_image_url(get_site_logo())}}" alt="" class="sidebar-logo">
            </span>
            <span class="logo-lg">
                <img src="{{get_image_url(get_site_logo())}}" alt="" class="sidebar-logo">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link @if($controller == 'DashboardController') active @endif" href="{{route('admin.dashboard')}}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboard</span>
                    </a>
                </li>

                @if(Auth::user()->can('role') || Auth::user()->can('user') || Auth::user()->can('customer'))
                <li class="menu-title"><span data-key="t-menu">Administration</span></li>
                @endif
                
                @if(Auth::user()->can('role') || Auth::user()->can('user'))
                <li class="nav-item">
                    <a class="nav-link menu-link @if(in_array($controller, ['RoleController','UserController'])) active @endif" href="#sidebarAdministrationUsersRoles" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAdministrationUsersRoles">
                        <i class=" ri-account-circle-line"></i> <span data-key="t-dashboards">Users & Roles</span>
                    </a>
                    <div class="collapse menu-dropdown @if(in_array($controller, ['RoleController','UserController'])) show @endif" id="sidebarAdministrationUsersRoles">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('user'))
                            <li class="nav-item">
                                <a href="{{route('admin.users')}}" class="nav-link @if($controller == 'UserController') active @endif" data-key="t-analytics"> Users </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('role'))
                            <li class="nav-item">
                                <a href="{{route('admin.roles')}}" class="nav-link @if($controller == 'RoleController') active @endif" data-key="t-analytics"> Roles </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('product') || Auth::user()->can('enquiry'))
                    <li class="menu-title"><span data-key="t-menu">Products & Enquiries</span></li>

                    @if(Auth::user()->can('product'))
                    <li class="nav-item">
                        <a href="{{route('admin.spa')}}" class="nav-link @if($controller == 'SpaController') active @endif" data-key="t-analytics">  
                        <i class="ri-shopping-cart-fill"></i> <span data-key="t-dashboards">Spa</span>
                        </a>
                    </li>
                    @endif

                    @if(Auth::user()->can('product'))
                    <li class="nav-item">
                        <a href="{{route('admin.spa.packages')}}" class="nav-link @if($controller == 'SpaPackagesController') active @endif" data-key="t-analytics">  
                        <i class="ri-shopping-cart-fill"></i> <span data-key="t-dashboards">Spa Packages</span>
                        </a>
                    </li>
                    @endif
                @endif
                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>