<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center h-100">
                <a class="text-body mr-3" href="{{route('website.about')}}">About</a>
                <a class="text-body mr-3" href="{{route('website.blog')}}">Blog</a>
                <a class="text-body mr-3" href="{{route('website.contact')}}">Contact</a>
                <a class="text-body mr-3" href="">Help</a>
                <a class="text-body mr-3" href="">FAQs</a>
            </div>
        </div>
        <div class="col-lg-6 text-right text-lg-right">
            <div class="d-inline-flex align-items-center">
                <div class="btn-group">    
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle " data-toggle="dropdown">{{ (auth()->check() ? 'Hello ' . auth()->user()->name : 'Sign in or Create an Account') }}
                    </button>
                    
                    <div class="dropdown-menu dropdown-menu-right">
                        @if (Route::has('login'))
                        @auth
                        <a class="dropdown-item btn" href="{{route('website.account.profile')}}">Profile</a>
                        <a class="dropdown-item btn" href="{{route('website.cart')}}">Cart</a>
                        <a class="dropdown-item btn" href="{{route('logout')}}">Log out</a>
                        @else 
                        <a class="dropdown-item btn" href="{{route('login')}}">Sign in</a>
                        @if(Route::has('register'))
                        <a class="dropdown-item btn" href="{{route('register')}}">Sign up</a>
                        @endif
                        @endauth
                        @endif
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle ms-2" data-toggle="dropdown">EN</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">FR</button>
                        <button class="dropdown-item" type="button">AR</button>
                        <button class="dropdown-item" type="button">RU</button>
                    </div>
                </div>
            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-heart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                </a>
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-shopping-cart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">Zaky</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Bakr</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form action="{{ route('website.shop')}}" method="get">
                <div class="input-group">
                    <input value="{{ Request::get('search')}}" type="text" class="form-control" name="search" id="search" placeholder="Search for products">
                    <div class="input-group-append">
                        <button  type="submit" class="input-group-text bg-transparent text-primary rounded-0">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-6 text-right">
            <p class="m-0">Customer Service</p>
            <h5 class="m-0">+012 345 6789</h5>
        </div>
    </div>
</div>