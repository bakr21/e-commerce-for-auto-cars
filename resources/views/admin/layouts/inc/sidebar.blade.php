<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{(Route::is('admin.dashboard')) ? 'active' : '' }}">
                    <a href="{{route('admin.dashboard')}}"><img src="{{asset('admin/assets/img/icons/dashboard.svg')}}" alt="img"><span>
                            Dashboard</span> </a>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{asset('admin/assets/img/icons/product.svg')}}" alt="img"><span>
                            Product</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{route('products.index')}}" class="{{(Route::is('products.index') || Route::is('products.edit') || Route::is('products.show')) ? 'active' : '' }}">Product List</a></li>
                        <li><a href="{{route('products.create')}}" class="{{(Route::is('products.create')) ? 'active' : '' }}">Add Product</a></li>
                        <li><a href="{{route('brands.index')}}"class="{{(Route::is('brands.index')) ? 'active' : '' }}">Brand List</a></li>
                        <li><a href="{{route('brands.create')}}"class="{{(Route::is('brands.create')) ? 'active' : '' }}">Add Brand</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="javascript:void(0);"><i class="fa-solid fa-layer-group"></i><span>
                        Category</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{route('categories.index')}}" class="{{ (Route::is('categories.index') || Route::is('categories.edit') || Route::is('categories.show')) ? 'active' : '' }}">Category List</a></li>
                        <li><a href="{{route('categories.create')}}" class="{{(Route::is('categories.create')) ? 'active' : '' }}">Add Category</a></li>
                    </ul>
                </li>

                <li class="{{(Route::is('shipping.create')) || Route::is('shipping.edit') ? 'active' : '' }}">
                    <a href="{{route('shipping.create')}}"><img src="{{asset('admin/assets/img/icons/quotation1.svg')}}" alt="img"><span>
                            Shipping</span> </a>
                </li>

                <li class="{{(Route::is('orders.index')) || Route::is('shipping.edit') ? 'active' : '' }}">
                    <a href="{{route('orders.index')}}"><img src="{{asset('admin/assets/img/icons/sales1.svg')}}" alt="img"><span>
                        Orders</span> </a>
                </li>

                <li class="{{(Route::is('coupons.index')) || Route::is('coupons.edit') ? 'active' : '' }}">
                    <a href="{{route('coupons.index')}}"><img src="{{asset('admin/assets/img/icons/sales1.svg')}}" alt="img"><span>
                        Coupons</span> </a>
                </li>

                <li class="{{ Route::is('reviews.index') ? 'active' : '' }}">
                    <a href="{{route('reviews.index')}}"><i class="fa-solid fa-star-half-stroke"></i><span>
                        Reviews</span> </a>
                </li>

                <li class="{{(Route::is('pages.index')) || Route::is('pages.edit') || Route::is('pages.create') ? 'active' : '' }}">
                    <a href="{{route('pages.index')}}"><i class="fa-regular fa-window-restore"></i><span>
                        CMS</span> </a>
                </li>

                <li class="{{(Route::is('message.index'))  ? 'active' : '' }}">
                    <a href="{{route('message.index')}}"><i class="fa-regular fa-comment"></i><span>
                        Messages</span> </a>
                </li>

                <li class="submenu">
                    <a href="javascript:void(0);"><i class="fa-solid fa-palette"></i><span>
                        Website Content</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('carousels.index')}}" class="{{(Route::is('carousels.index')) || Route::is('carousels.edit') || Route::is('carousels.create') ? 'active' : '' }}">Main Carousel</a></li>
                        <li><a href="{{ route('side-banners.index')}}" class="{{(Route::is('side-banners.index')) || Route::is('side-banners.edit') || Route::is('side-banners.create') ? 'active' : '' }}">Side Banners</a></li>
                        <li><a href="{{ route('catalogs.index')}}" class="{{(Route::is('catalogs.index')) || Route::is('catalogs.edit') || Route::is('catalogs.create') ? 'active' : '' }}">Catalogs</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{asset('admin/assets/img/icons/users1.svg')}}" alt="img"><span>
                        Users</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('users.index')}}" class="{{(Route::is('users.index')) || Route::is('users.edit') ? 'active' : '' }}">User List</a></li>
                        <li><a href="{{ route('users.create')}}" class="{{(Route::is('users.create')) ? 'active' : '' }}">Add User</a></li>
                    </ul>
                </li>

                {{-- found in dashboard  --}}

                {{-- <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{asset('admin/assets/img/icons/time.svg')}}" alt="img"><span>
                        Reports</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="" class="">Top Products Report</a></li>
                            <li><a href="" class="">Best Customers Report</a></li>
                        </ul>
                    </li> --}}

                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{asset('admin/assets/img/icons/settings.svg')}}" alt="img"><span>
                        Settings</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('settings.edit')}}" class="{{(Route::is('settings.edit')) ? 'active' : '' }}">General Settings</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
