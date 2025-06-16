<div class="container-fluid bg-dark text-secondary mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
            <p class="mb-4">{{$site_settings->company_description}}</p>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{$site_settings->address}}</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{$site_settings->email}}</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{$site_settings->phone_number}}</p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="{{ route('home') }}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                        <a class="text-secondary mb-2" href="{{ route('website.shop') }}"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                        <a class="text-secondary mb-2" href="{{ route('website.categories') }}"><i class="fa fa-angle-right mr-2"></i>Categories</a>
                        <a class="text-secondary mb-2" href="{{ route('website.cart') }}"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                        <a class="text-secondary mb-2" href="{{ route('checkout.index') }}"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                        <a class="text-secondary" href="{{ route('website.catalogs') }}"><i class="fa fa-angle-right mr-2"></i>Catalogs</a>
                    </div>
                </div>
                <div class="col-md-3 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Information</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="{{ route('website.about') }}"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                        <a class="text-secondary mb-2" href="{{ url('page/contact-us') }}"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        <a class="text-secondary mb-2" href="{{ url('page/privacy-policy') }}"><i class="fa fa-angle-right mr-2"></i>Privacy Policy</a>
                        <a class="text-secondary mb-2" href="{{ url('page/terms-conditions') }}"><i class="fa fa-angle-right mr-2"></i>Terms & Conditions</a>
                        <a class="text-secondary mb-2" href="{{ url('page/faq') }}"><i class="fa fa-angle-right mr-2"></i>FAQ</a>
                        <a class="text-secondary" href="{{ route('login') }}"><i class="fa fa-angle-right mr-2"></i>My Account</a>
                    </div>
                </div>
                <div class="col-md-5 mb-5">
                    <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex">
                        @if (!empty($site_settings->twitter_link))
                            <a class="btn btn-primary btn-square mr-2" href="{{ $site_settings->twitter_link }}" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif
                        @if (!empty($site_settings->facebook_link))
                            <a class="btn btn-primary btn-square mr-2" href="{{ $site_settings->facebook_link }}" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if (!empty($site_settings->linkedin_link))
                            <a class="btn btn-primary btn-square mr-2" href="{{ $site_settings->linkedin_link }}" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        @endif
                        @if (!empty($site_settings->instagram_link))
                            <a class="btn btn-primary btn-square" href="{{ $site_settings->instagram_link }}" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="col-md-6 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-secondary">
                &copy; <a class="text-primary" href="{{ route('home') }}">{{ $site_settings->site_name ?? 'zakybakr.com' }}</a>. All Rights Reserved. Web Developer
                by
                <a class="text-primary" href="{{ route('home') }}">Ahmed Bakr</a>
            </p>
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right">
            <img class="img-fluid" src="{{asset('website/assets/img/payments.png')}}" alt="">
        </div>
    </div>
</div>

