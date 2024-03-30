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
                        <a href="{{route('admin.product')}}" class="nav-link @if($controller == 'ProductController') active @endif" data-key="t-analytics">  
                        <i class="ri-shopping-cart-fill"></i> <span data-key="t-dashboards">Product</span>
                        </a>
                    </li>
                    @endif

                    @if(Auth::user()->can('enquiry'))
                    <li class="nav-item">
                        <a href="{{route('admin.enquiry')}}" class="nav-link @if($controller == 'EnquiryController') active @endif" data-key="t-analytics"> 
                        <i class=" ri-chat-1-line"></i> <span data-key="t-dashboards">Enquiry</span>
                        </a>
                    </li>
                    @endif
                @endif

                @if(Auth::user()->can('slider') || Auth::user()->can('pages') || Auth::user()->can('gallery') || Auth::user()->can('logo'))
                    <li class="menu-title"><span data-key="t-menu">Content Management</span></li>
                
                    @if(Auth::user()->can('slider'))
                    <li class="nav-item">
                        <a href="{{route('admin.slider')}}" class="nav-link @if($controller == 'SliderController') active @endif" data-key="t-analytics">  
                        <i class="bx bx-slider-alt"></i> <span data-key="t-dashboards">Home Slider</span>
                        </a>
                    </li>
                    @endif

                    @if(Auth::user()->can('pages'))
                    <li class="nav-item">
                        <a href="{{route('admin.pages')}}" class="nav-link @if($controller == 'PagesController') active @endif" data-key="t-analytics">  
                        <i class="ri-pages-line"></i> <span data-key="t-dashboards">Content Pages</span>
                        </a>
                    </li>
                    @endif

                    @if(Auth::user()->can('gallery'))
                    <li class="nav-item">
                        <a href="{{route('admin.gallery')}}" class="nav-link @if($controller == 'GalleryController') active @endif" data-key="t-analytics"> 
                        <i class="bx bx-image-alt"></i> <span data-key="t-dashboards">Gallery</span>
                        </a>
                    </li>
                    @endif

                    @if(Auth::user()->can('logo'))
                    <li class="nav-item">
                        <a href="{{route('admin.logo')}}" class="nav-link @if($controller == 'LogoController') active @endif" data-key="t-analytics"> 
                        <i class="bx bxs-file-image"></i> <span data-key="t-dashboards">Logo</span>
                        </a>
                    </li>
                    @endif
                @endif

                @if(Auth::user()->can('product_type') || Auth::user()->can('product_use_in') || Auth::user()->can('product_use_type') || Auth::user()->can('product_usage') || Auth::user()->can('home_category'))
                <li class="menu-title"><span data-key="t-menu">Master Management</span></li>
                
                    @if(Auth::user()->can('product_type'))
                    <li class="nav-item">
                        <a href="{{route('admin.product.type')}}" class="nav-link @if($controller == 'ProductTypeController') active @endif" data-key="t-analytics">  
                            <i class=" ri-git-repository-private-fill"></i> <span data-key="t-dashboards">Product Type</span>
                        </a>
                    </li>
                    @endif

                    @if(Auth::user()->can('product_use_in'))
                    <li class="nav-item">
                        <a href="{{route('admin.product.usein')}}" class="nav-link @if($controller == 'ProductUseinController') active @endif" data-key="t-analytics"> 
                        <i class="ri-hard-drive-2-fill"></i> <span data-key="t-dashboards">Product Used In</span>
                        </a>
                    </li>
                    @endif

                    @if(Auth::user()->can('product_use_type'))
                    <li class="nav-item">
                        <a href="{{route('admin.product.usetype')}}" class="nav-link @if($controller == 'ProductUsetypeController') active @endif" data-key="t-analytics"> 
                        <i class="ri-book-3-fill"></i> <span data-key="t-dashboards">Product Used Type</span>
                        </a>
                    </li>
                    @endif

                    @if(Auth::user()->can('product_usage'))
                    <li class="nav-item">
                        <a href="{{route('admin.product.usage')}}" class="nav-link @if($controller == 'ProductUsageController') active @endif" data-key="t-analytics"> 
                        <i class="ri-book-read-fill"></i> <span data-key="t-dashboards">Product Usage</span>
                        </a>
                    </li>
                    @endif

                    @if(Auth::user()->can('home_category'))
                    <li class="nav-item">
                        <a href="{{route('admin.home.category')}}" class="nav-link @if($controller == 'HomeCategoryController') active @endif" data-key="t-analytics"> 
                        <i class="ri-shopping-bag-3-fill"></i> <span data-key="t-dashboards">Home Category</span>
                        </a>
                    </li>
                    @endif

                    @if(Auth::user()->can('technical_specifications'))
                    <li class="nav-item">
                        <a href="{{route('admin.technical.specifications')}}" class="nav-link @if($controller == 'TechnicalSpecificationsController') active @endif" data-key="t-analytics"> 
                        <i class="ri-vip-diamond-fill"></i> <span data-key="t-dashboards">Technical Specifications</span>
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