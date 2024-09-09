<ul id="account-panel" class="navbar-nav bg-light p-3 mb-30 flex-column ">
    <li class="nav-item nav-link bg-dark p-3 mb-3">
        <a href="{{ route('website.account.profile')}}" class="text-decoration-none p-2 {{(Route::is('website.account.profile')) ? 'text-white' : '' }}" role="tab" aria-controls="tab-login"
            aria-expanded="false"><i class="fas fa-user-alt"></i> My Profile</a>
    </li>
    <li class="nav-item nav-link bg-dark p-3 mb-3">
        <a href="{{ route('website.account.orders')}}" class="text-decoration-none p-2 {{(Route::is('website.account.orders') || Route::is('website.account.orderdetail')) ? 'text-white' : '' }}" role="tab" aria-controls="tab-register"
            aria-expanded="false"><i class="fas fa-shopping-bag"></i> My Orders</a>
    </li>
    <li class="nav-item nav-link bg-dark p-3 mb-3">
        <a href="{{ route('website.account.wishlist')}}" class="text-decoration-none p-2 {{(Route::is('website.account.wishlist')) ? 'text-white' : '' }}" role="tab" aria-controls="tab-register"
            aria-expanded="false"><i class="fas fa-heart"></i> Wishlist</a>
    </li>
    <li class="nav-item nav-link bg-dark p-3 mb-3">
        <a href="change-password.php" class="text-decoration-none p-2" role="tab" aria-controls="tab-register"
            aria-expanded="false"><i class="fas fa-lock"></i> Change Password</a>
    </li>
    <li class="nav-item nav-link bg-dark p-3 mb-3">
        <a href="{{route('logout')}}" class="text-decoration-none p-2" role="tab" aria-controls="tab-register"
            aria-expanded="false"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </li>
</ul>
