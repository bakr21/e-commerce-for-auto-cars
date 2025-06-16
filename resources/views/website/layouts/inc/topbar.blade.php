<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center h-100">
                <a class="text-body mr-3" href="{{route('website.about')}}">{{__('navbar.about')}}</a>
                <a class="text-body mr-3" href="{{ url('page/contact-us') }}">{{__('navbar.contact')}}</a>
            </div>
        </div>
        <div class="col-lg-6 text-right text-lg-right">
            <div class="d-inline-flex align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                        {{ auth()->check() ? __('navbar.welcome_user', ['name' => auth()->user()->name]) : __('navbar.Sign_in_or_create_an_account') }}
                    </button>


                    <div class="dropdown-menu dropdown-menu-right">
                        @if (Route::has('login'))
                        @auth
                        <a class="dropdown-item btn" href="{{route('website.account.profile')}}">{{__('navbar.my_account')}}</a>
                        <a class="dropdown-item btn" href="{{route('website.account.orders')}}">{{__('navbar.my_orders')}}</a>
                        <a class="dropdown-item btn" href="{{route('website.cart')}}">{{__('navbar.cart')}}</a>
                        <a class="dropdown-item btn" href="{{route('website.account.wishlist')}}">{{__('navbar.my_wishlist')}}</a>
                        <a class="dropdown-item btn" href="{{route('logout')}}">{{__('navbar.logout')}}</a>
                        @else
                        <a class="dropdown-item btn" href="{{route('login')}}">{{__('navbar.login')}}</a>
                        @if(Route::has('register'))
                        <a class="dropdown-item btn" href="{{route('register')}}">{{__('navbar.register')}}</a>
                        @endif
                        @endauth
                        @endif
                    </div>
                </div>
                <div class="dropdown ms-2">
                    <button class="btn btn-sm btn-light dropdown-toggle d-flex align-items-center" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fi fi-{{ app()->getLocale() == 'en' ? 'us' : (app()->getLocale() == 'ar' ? 'eg' : app()->getLocale()) }} me-2"></span>
                        {{ strtoupper(app()->getLocale()) }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a class="dropdown-item d-flex align-items-center {{ app()->getLocale() == $localeCode ? 'active' : '' }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    <span class="fi fi-{{ $localeCode == 'en' ? 'us' : ($localeCode == 'ar' ? 'eg' : $localeCode) }} me-2"></span>
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
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
            <a href="#" class="text-decoration-none">
                @php
                    $siteName = $site_settings->site_name ;
                    $nameParts = explode(' ', $siteName);
                @endphp

                @if(count($nameParts) == 1)
                    <span class="h1 text-uppercase text-primary bg-dark px-2">{{ $nameParts[0] }}</span>
                @elseif(count($nameParts) == 2)
                    <span class="h1 text-uppercase text-primary bg-dark px-2">{{ $nameParts[0] }}</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">{{ $nameParts[1] }}</span>
                @else
                    <span class="h1 text-uppercase text-primary bg-dark px-2">{{ $nameParts[0] }}</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">{{ $nameParts[1] }}</span>
                    <span class="h1 text-uppercase text-primary bg-dark px-2">{{ implode(' ', array_slice($nameParts, 2)) }}</span>
                @endif
            </a>
        </div>

        <div class="col-lg-4">
            <form action="{{ route('website.shop')}}" method="get">
                <div class="input-group">
                    <input value="{{ Request::get('search')}}" type="text" class="form-control" name="search" id="search" placeholder="{{__('navbar.search_placeholder')}}" aria-label="Search" aria-describedby="button-addon1">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text bg-transparent text-primary rounded-0">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-4 text-lg-right ml-auto">
            <div>
                <p class="m-0">{{__('navbar.call_us')}}</p>
                <h5 class="m-0">{{$site_settings->hotline}}</h5>
            </div>
        </div>
    </div>


</div>

