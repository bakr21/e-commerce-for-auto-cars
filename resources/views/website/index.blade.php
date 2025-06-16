@extends('website.layouts.master')
@section('TitlePage' , 'Home')
@section('content')
<!-- Carousel Start -->
    @include('website.sections.carousel')
<!-- Carousel End -->

<!-- Hero Banner Start -->
<div class="container-fluid py-5 hero-banner">
    <div class="row px-xl-5">
        <div class="col-12">
            <div class="hero-banner-content">
                <h2 class="fade-in">{{__('homepage.best_auto_parts')}}</h2>
                <p class="slide-in-left">{{__('homepage.we_provide')}}</p>
                <a href="#featured-products" class="btn btn-primary btn-lg bounce">{{__('homepage.shop_now')}}</a>
            </div>
        </div>
    </div>
</div>
<!-- Hero Banner End -->

<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1" >
            <div class="feature-box d-flex align-items-center bg-light mb-4" data-aos="fade-up" data-aos-delay="100" style="padding: 30px;">
                <div class="feature-icon">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                </div>
                <h5 class="font-weight-semi-bold m-0">{{__('home.quality_product')}}</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="feature-box d-flex align-items-center bg-light mb-4" data-aos="fade-up" data-aos-delay="200" style="padding: 30px;">
                <div class="feature-icon">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                </div>
                <h5 class="font-weight-semi-bold m-0">{{__('home.fast_delivery')}}</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="feature-box d-flex align-items-center bg-light mb-4" data-aos="fade-up" data-aos-delay="300" style="padding: 30px;">
                <div class="feature-icon">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                </div>
                <h5 class="font-weight-semi-bold m-0">{{__('home.14_day_returns')}}</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="feature-box d-flex align-items-center bg-light mb-4" data-aos="fade-up" data-aos-delay="400" style="padding: 30px;">
                <div class="feature-icon">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                </div>
                <h5 class="font-weight-semi-bold m-0">{{__('home.customer_support')}}</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->
    @include('website.sections.trend-categories')
<!-- Categories End -->


<!-- Products Start -->
    @include('website.sections.trend-products')
<!-- Products End -->

<!-- Promo Banner Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        <div class="col-md-6" data-aos="fade-up">
            <div class="promo-banner mb-30" style="height: 300px;">
                <div class="promo-banner-overlay"></div>
                <img class="img-fluid w-100 h-100" src="{{asset('website/assets/img/offer-1-n.webp')}}" alt="" style="object-fit: cover;">
                <div class="promo-banner-content">
                    <h6 class="text-white text-uppercase fade-in">{{__('homepage.special_offers')}}</h6>
                    <h3 class="text-white mb-3 slide-in-left">{{__('homepage.luxury_parts')}}</h3>
                    <a href="{{route('website.shop')}}" class="btn btn-primary">{{__('homepage.shop_now')}}</a>
                </div>
            </div>
        </div>
        <div class="col-md-6" data-aos="fade-down">
            <div class="promo-banner mb-30" style="height: 300px;">
                <div class="promo-banner-overlay"></div>
                <img class="img-fluid w-100 h-100" src="{{asset('website/assets/img/offer-2-n.webp')}}" alt="" style="object-fit: cover;">
                <div class="promo-banner-content">
                    <h6 class="text-white text-uppercase fade-in">{{__('homepage.new_arrivals')}}</h6>
                    <h3 class="text-white mb-3 slide-in-right">{{__('homepage.latest_collections')}}</h3>
                    <a href="{{route('website.categories')}}" class="btn btn-primary">{{__('homepage.explore_now')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Promo Banner End -->


<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4" data-aos="fade-down"><span class="bg-secondary pr-3">{{__('home.vendors')}}</span></h2>

    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <div class="bg-light p-4" data-aos="zoom-in" data-aos-delay="100">
                    <img src="{{asset('website/assets/img/mahle.png')}}" alt="Mahle" class="pulse">
                </div>
                <div class="bg-light p-4" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{asset('website/assets/img/sorl.png')}}" alt="Sorl" class="pulse">
                </div>
                <div class="bg-light p-4" data-aos="zoom-in" data-aos-delay="300">
                    <img src="{{asset('website/assets/img/mannfilter.png')}}" alt="Mann Filter" class="pulse">
                </div>
                <div class="bg-light p-4" data-aos="zoom-in" data-aos-delay="400">
                    <img src="{{asset('website/assets/img/bendix.png')}}" alt="Bendix" class="pulse">
                </div>
                <div class="bg-light p-4" data-aos="zoom-in" data-aos-delay="500">
                    <img src="{{asset('website/assets/img/smg.png')}}" alt="SMG" class="pulse">
                </div>
                <div class="bg-light p-4" data-aos="zoom-in" data-aos-delay="600">
                    <img src="{{asset('website/assets/img/hella.png')}}" alt="Hella" class="pulse">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Us Start -->
<div class="container-fluid py-5 bg-light">
    <div class="row px-xl-5 py-5">
        <div class="col-lg-6" data-aos="zoom-in">
            <h2 class="mb-4">{{__('homepage.why_choose_us')}}</h2>
            <p class="mb-4">{{__('homepage.why_choose_description')}}</p>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-center scroll-animation">
                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white" style="width: 50px; height: 50px;">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="ml-3">
                            <h5 class="mb-0">{{__('homepage.original_products')}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-center scroll-animation">
                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white" style="width: 50px; height: 50px;">
                            <i class="fa fa-shipping-fast"></i>
                        </div>
                        <div class="ml-3">
                            <h5 class="mb-0">{{__('homepage.fast_shipping')}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-center scroll-animation">
                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white" style="width: 50px; height: 50px;">
                            <i class="fa fa-exchange-alt"></i>
                        </div>
                        <div class="ml-3">
                            <h5 class="mb-0">{{__('homepage.14_days_return')}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-center scroll-animation">
                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white" style="width: 50px; height: 50px;">
                            <i class="fa fa-phone-volume"></i>
                        </div>
                        <div class="ml-3">
                            <h5 class="mb-0">{{__('homepage.24_7_support')}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="btn btn-primary mt-3 my-3">{{__('homepage.learn_more')}}</a>
        </div>
        <div class="col-lg-6" data-aos="">
            <div class="position-relative" style="height: 100%; min-height: 400px;">
                <img class="img-fluid w-100 h-100" src="{{asset('website/assets/img/pexels-pixabay-159293.jpg')}}" alt="About Us" style="object-fit: cover; border-radius: 5px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
            </div>
        </div>
    </div>
</div>
<!-- Why Choose Us End -->
<!-- Vendor End -->
@endsection
