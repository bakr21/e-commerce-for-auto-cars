<div class="container-fluid mb-3">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($carousels as $key => $carousel)
                    <li data-target="#header-carousel" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @forelse($carousels as $key => $carousel)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="height: 430px;">
                        <img src="{{ Storage::url($carousel->image) }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $carousel->title_en }}">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3 text-center" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{ app()->getLocale() == 'en' ? $carousel->title_en : $carousel->title_ar }}</h1>
                                <p class="text-white px-md-5 animate__animated animate__fadeInUp animate__delay-1s">{{ app()->getLocale() == 'en' ? $carousel->description_en : $carousel->description_ar }}</p>
                                <a class="btn btn-primary py-2 px-4 mt-3 animate__animated animate__bounceIn animate__delay-2s" href="{{ $carousel->button_link ?? '#' }}">{{ app()->getLocale() == 'en' ? $carousel->button_text_en : $carousel->button_text_ar }}</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="carousel-item active" style="height: 430px;">
                        <img src="{{asset('website/assets/img/phpd1.png')}}" class="w-100 h-100" style="object-fit: cover;" alt="Auto Parts">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3 text-center" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{__('carousel.mercedes_parts')}}</h1>
                                <p class="text-white px-md-5 animate__animated animate__fadeInUp animate__delay-1s">{{__('carousel.mercedes_description')}}</p>
                                <a class="btn btn-primary py-2 px-4 mt-3 animate__animated animate__bounceIn animate__delay-2s" href="#">{{__('carousel.shop_now')}}</a>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Side Promotions -->
        <div class="col-lg-4">
            @forelse($sideBanners->where('position', 1)->take(1) as $topBanner)
            <div class="promo-banner mb-30" style="height: 200px; position: relative; border-radius: 5px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                <div class="promo-banner-overlay"></div>
                <img class="img-fluid w-100 h-100" loading="lazy" src="{{ Storage::url($topBanner->image) }}" alt="{{ $topBanner->title_en }}" style="object-fit: cover;">
                <div class="promo-banner-content">
                    <h6 class="text-white text-uppercase slide-in-left">{{ app()->getLocale() == 'en' ? $topBanner->title_en : $topBanner->title_ar }}</h6>
                    <h3 class="text-white mb-3 fade-in">{{ app()->getLocale() == 'en' ? $topBanner->subtitle_en : $topBanner->subtitle_ar }}</h3>
                    <a href="{{ $topBanner->button_link ?? '#' }}" class="btn btn-primary">{{ app()->getLocale() == 'en' ? $topBanner->button_text_en : $topBanner->button_text_ar }}</a>
                </div>
            </div>
            @empty
            <div class="promo-banner mb-30" style="height: 200px; position: relative; border-radius: 5px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                <div class="promo-banner-overlay"></div>
                <img class="img-fluid w-100 h-100" loading="lazy" src="{{ asset('website/assets/img/offer-1-n.webp') }}" alt="" style="object-fit: cover;">
                <div class="promo-banner-content">
                    <h6 class="text-white text-uppercase slide-in-left">{{__('carousel.discover_products')}}</h6>
                    <h3 class="text-white mb-3 fade-in">{{__('carousel.shop_save')}}</h3>
                    <a href="#" class="btn btn-primary">{{__('carousel.discover_now')}}</a>
                </div>
            </div>
            @endforelse

            @forelse($sideBanners->where('position', 2)->take(1) as $bottomBanner)
            <div class="promo-banner mb-30" style="height: 200px; position: relative; border-radius: 5px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                <div class="promo-banner-overlay"></div>
                <img class="img-fluid w-100 h-100" loading="lazy" src="{{ Storage::url($bottomBanner->image) }}" alt="{{ $bottomBanner->title_en }}" style="object-fit: cover;">
                <div class="promo-banner-content">
                    <h6 class="text-white text-uppercase slide-in-right">{{ app()->getLocale() == 'en' ? $bottomBanner->title_en : $bottomBanner->title_ar }}</h6>
                    <h3 class="text-white mb-3 fade-in">{{ app()->getLocale() == 'en' ? $bottomBanner->subtitle_en : $bottomBanner->subtitle_ar }}</h3>
                    <a href="{{ $bottomBanner->button_link ?? '#' }}" class="btn btn-primary">{{ app()->getLocale() == 'en' ? $bottomBanner->button_text_en : $bottomBanner->button_text_ar }}</a>
                </div>
            </div>
            @empty
            <div class="promo-banner mb-30" style="height: 200px; position: relative; border-radius: 5px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                <div class="promo-banner-overlay"></div>
                <img class="img-fluid w-100 h-100" loading="lazy" src="{{ asset('website/assets/img/offer-2-n.webp') }}" alt="" style="object-fit: cover;">
                <div class="promo-banner-content">
                    <h6 class="text-white text-uppercase slide-in-right">{{__('carousel.everything_you_need')}}</h6>
                    <h3 class="text-white mb-3 fade-in">{{__('carousel.explore_catalog')}}</h3>
                    <a href="{{ route('website.catalogs') }}" class="btn btn-primary">{{__('carousel.start_browsing')}}</a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
