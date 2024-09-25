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
                        <li><a href="importproduct.html">Import Products</a></li>
                        <li><a href="barcode.html">Print Barcode</a></li>
                    </ul>
                </li>
                
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="fa-solid fa-layer-group"></i><span>
                        Category</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{route('categories.index')}}" class="{{ (Route::is('categories.index') || Route::is('categories.edit') || Route::is('categories.show')) ? 'active' : '' }}">Category List</a></li>
                        <li><a href="{{route('categories.create')}}" class="{{(Route::is('categories.create')) ? 'active' : '' }}">Add Category</a></li>
                        <li><a href="subcategorylist.html">Sub Category List</a></li>
                        <li><a href="subaddcategory.html">Add Sub Category</a></li>
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

                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{asset('admin/assets/img/icons/users1.svg')}}" alt="img"><span>
                            People</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="customerlist.html">Customer List</a></li>
                        <li><a href="addcustomer.html">Add Customer </a></li>
                        <li><a href="supplierlist.html">Supplier List</a></li>
                        <li><a href="addsupplier.html">Add Supplier </a></li>
                        <li><a href="{{ route('users.index')}}" class="{{(Route::is('users.index')) || Route::is('users.edit') ? 'active' : '' }}">User List</a></li>
                        <li><a href="{{ route('users.create')}}" class="{{(Route::is('users.create')) ? 'active' : '' }}">Add User</a></li>
                    </ul>
                </li>

                <li class="{{(Route::is('pages.index')) || Route::is('pages.edit') || Route::is('pages.create') ? 'active' : '' }}">
                    <a href="{{route('pages.index')}}"><i class="fa-regular fa-window-restore"></i><span>
                        Pages</span> </a>
                </li>
            </ul>
        </div>
    </div>
</div>