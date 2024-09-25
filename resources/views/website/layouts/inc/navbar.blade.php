<div class="container-fluid bg-dark mb-30 ">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <div class="navbar-nav w-100">
                    <div class="nav-item dropdown dropright">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dresses <i class="fa fa-angle-right float-right mt-1"></i></a>
                        <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                            <a href="" class="dropdown-item">Men's Dresses</a>
                            <a href="" class="dropdown-item">Women's Dresses</a>
                            <a href="" class="dropdown-item">Baby's Dresses</a>
                        </div>
                    </div> 
                    @foreach($categories as $category)
                <a href="{{ route('website.category_slug' , $category->slug)}}" class="nav-item nav-link">{{ $category->meta_title }}</a>
                    @endforeach
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">Auto</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Cars</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{route('home')}}" class="nav-item nav-link {{(Route::is('home')) ? 'active' : '' }}">Home</a>
                        <a href="{{route('website.shop')}}" class="nav-item nav-link {{(Route::is('website.shop')) ? 'active' : '' }}">Shop</a>
                        <a href="{{route('website.blog.index')}}" class="nav-item nav-link {{(Route::is('website.blog.index')) ? 'active' : '' }}">Blogs</a>
                        <a href="{{route('website.categories')}}" class="nav-item nav-link {{(Route::is('website.categories')) ? 'active' : '' }}">Categories</a>
                        <a href="{{route('website.contact')}}" class="nav-item nav-link {{(Route::is('website.contact')) ? 'active' : '' }}" >Contact</a>
                    </div>
                    @php
                        use App\Models\Cart; 
                        $cart_products = Cart::with('product')->where('user_id', Auth::id())->get();
                        $cart_count = $cart_products->count();
                    @endphp
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a href="{{route('website.account.wishlist')}}" class="btn px-0">
                            <i class="fas fa-heart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">
                                {{ $wishlistCount }}
                            </span>
                        </a>
                        <a href="{{route('website.cart')}}" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span id="cart-count" class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">
                                {{ $cart_count }}
                            </span>
                        </a>
                        
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>