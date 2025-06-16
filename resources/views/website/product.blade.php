@extends('website.layouts.master')
@section('TitlePage' , $product->name)
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">{{__('breadcrumb.home')}}</a>
                    <a class="breadcrumb-item text-dark" href="#">{{__('breadcrumb.shop')}}</a>
                    <span class="breadcrumb-item active">{{__('breadcrumb.shop_detail')}}</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Detail Start -->
    @php
    use Illuminate\Support\Facades\Auth;
    @endphp
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        @if($product->images->isEmpty())
                            <div class=" active">
                                <img class="image-product" src="{{ asset('admin/assets/img/product/noimage.png') }}" alt="{{ $product->name }}">
                            </div>
                        @else
                            @foreach($product->images as $index => $image)
                                @if($image && $image->image_path)
                                    <div class=" {{ $loop->first ? 'active' : '' }}">
                                        <img class="image-product" src="{{ Storage::url($image->image_path) }}" alt="{{ $product->name }}">
                                    </div>
                                @else
                                    <div class=" {{ $loop->first ? 'active' : '' }}">
                                        <img class="image-product" src="{{ asset('admin/assets/img/product/noimage.png') }}" alt="{{ $product->name }}">
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{$product->name}}</h3>
                    @if($product->selling_price < $product->price)
                    <div class="badge bg-danger text-white position-absolute" style="top: 10px; left: 10px; z-index: 1; padding: 5px 10px; border-radius: 3px;">
                        {{ round((($product->price - $product->selling_price) / $product->price) * 100) }}% {{__('product.discount')}}
                    </div>
                    @endif
                    <div class="d-flex mb-3">
                        <div class="text-primary star-rating mt-2" title="{{ $product->avgRatingPer }}%">
                            <div class="back-stars">
                                <small class="fa fa-star"></small>
                                <small class="fa fa-star"></small>
                                <small class="fa fa-star"></small>
                                <small class="fa fa-star"></small>
                                <small class="fa fa-star"></small>
                                <div class="front-stars" style="width: {{ $product->avgRatingPer }}%">
                                    <small class="fa fa-star"></small>
                                    <small class="fa fa-star"></small>
                                    <small class="fa fa-star"></small>
                                    <small class="fa fa-star"></small>
                                    <small class="fa fa-star"></small>
                                </div>
                            </div>
                        </div>
                        <small class="pt-1">
                            ({{ $product->product_ratings_count }}
                            {{ $product->product_ratings_count > 1 ? __('product.reviews') : __('product.review') }})
                        </small>

                    </div>
                    <div class="d-flex mb-3">
                        <a class="btn btn-sm btn-primary me-2 rounded ps-3 pe-3" href="{{route('website.category_slug' , $product->category->slug)}}">{{$product->category->name}}</a>
                        @if($product->brand)
                        <a class="btn btn-sm btn-outline-primary rounded ps-3 pe-3" href="{{ route('website.shop') }}?brand={{ $product->brand_id }}">{{$product->brand->name}}</a>
                        @endif
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$product->selling_price}} {{__('product.egp')}}
                        @if($product->selling_price < $product->price)
                            <del class="text-muted ml-2">{{$product->price}} {{__('product.egp')}}</del>
                        @endif
                    </h3>
                    <p class="mb-3">{{$product->short_description}}</p>
                    <div class="mb-3">
                        <strong class="text-dark mr-1">{{__('product.availability')}}:</strong>
                        @if($product->qty >= $product->minqty)
                            <small class="badge bg-primary p-2 text-muted">{{__('product.available')}}</small>
                        @else
                            <small class="badge bg-danger p-2">{{__('product.unavailable')}}</small>
                        @endif
                    </div>
                    @if(!Auth::check())
                        <p class="fw-bold">
                            {!! __('product.login_prompt', ['link' => '<a href="' . route('login') . '">' . __('product.login') . '</a>']) !!}
                        </p>
                    @endif

                    @if($product->qty >= $product->minqty)
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" id="qty_value" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <a class="btn btn-primary px-3" onclick="addtocart()" ><i class="fa fa-shopping-cart mr-1"></i> {{__('product.add_to_cart')}}</a>
                        <input type="hidden" id="product_id" name="product_id" value="{{$product->id}}" />
                    </div>
                    @endif
                    @php
                        $productUrl = urlencode(request()->fullUrl());
                        $productTitle = urlencode($product->name);
                    @endphp

                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">{{__('product.share_on')}} :</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="https://www.facebook.com/sharer/sharer.php?u={{ $productUrl }}" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="https://api.whatsapp.com/send?text={{ $productTitle }}%20{{ $productUrl }}" target="_blank">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a class="text-dark px-2" href="https://twitter.com/intent/tweet?url={{ $productUrl }}&text={{ $productTitle }}" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="https://www.linkedin.com/sharing/share-offsite/?url={{ $productUrl }}" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="https://pinterest.com/pin/create/button/?url={{ $productUrl }}&description={{ $productTitle }}" target="_blank">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">{{__('product.description')}}</a>
                        {{-- <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a> --}}
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#reviews">
                            {{ __('product.reviews') }} ({{ $product->product_ratings_count }}
                            {{ $product->product_ratings_count > 1 ? __('product.reviews') : __('product.review') }})
                        </a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">{{__('product.description')}}</h4>
                            <p>{!! $product->description !!}</p>
                        </div>
                        {{-- <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Additional Information</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="row">
                                <div class="col-md-7">
                                    <form action="{{ route('rating.save', $product->id) }}" name="productRatingForm" id="productRatingForm" method="post">
                                    @csrf
                                    <div class="row">
                                            <h3 class="h4 pb-3">{{__('product.write_review')}}</h3>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="name">{{__('product.name')}}</label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="{{__('product.name')}}">
                                                <p></p>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="email">{{__('product.email')}}</label>
                                                <input type="text" class="form-control" name="email" id="email" placeholder="{{__('product.email')}}">
                                                <p></p>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="rating">{{__('product.rating')}}</label>
                                                <br>
                                                <div class="rating ms-1" id="rating" style="width: 10rem">
                                                    <input id="rating-5" type="radio" name="rating" value="5"/><label for="rating-5"><i class="fas fa-3x fa-star"></i></label>
                                                    <input id="rating-4" type="radio" name="rating" value="4"  /><label for="rating-4"><i class="fas fa-3x fa-star"></i></label>
                                                    <input id="rating-3" type="radio" name="rating" value="3"/><label for="rating-3"><i class="fas fa-3x fa-star"></i></label>
                                                    <input id="rating-2" type="radio" name="rating" value="2"/><label for="rating-2"><i class="fas fa-3x fa-star"></i></label>
                                                    <input id="rating-1" type="radio" name="rating" value="1"/><label for="rating-1"><i class="fas fa-3x fa-star"></i></label>
                                                </div>
                                                <p></p>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="">{{__('product.overall_experience')}}</label>
                                                <textarea name="comment"  id="comment" class="form-control" cols="30" rows="10" placeholder="{{__('product.overall_experience')}}"></textarea>
                                                <p></p>
                                            </div>
                                            <div>
                                                @if (!Auth::user())
                                                    <p class="fw-bold">
                                                        {!! __('product.must_login', ['link' => '<a href="' . route('login') . '">' . __('product.login') . '</a>']) !!}
                                                    </p>
                                                @endif
                                                <button type="submit" {{ !Auth::user() ? 'disabled' : '' }} class="btn btn-primary">{{__('product.submit')}}</button>
                                                </div>
                                            </div>
                                        </form>
                                </div>
                                <div class="col-md-5 mt-5">
                                    <div class="overall-rating mb-3">
                                        <div class="d-flex">
                                            <h1 class="h3 pe-3">
                                                {{ $product->avgRatingPer > 0 ? number_format($product->avgRatingPer / 100, 1) : '0.0' }}
                                            </h1>
                                            <div class="star-rating mt-2" title="{{$product->avgRatingPer}}%">
                                                <div class="back-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <div class="front-stars" style="width: {{$product->avgRatingPer}}%">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-2 ps-2">
                                                ({{ $product->product_ratings_count }}
                                                {{ $product->product_ratings_count > 1 ? __('product.reviews') : __('product.review') }})
                                            </div>
                                        </div>
                                    </div>

                                    @foreach ($product->product_ratings as $rating)
                                        @php $ratingPer = ($rating->rating * 100) / 5; @endphp
                                        <div class="rating-group mb-4">
                                            <span><strong>{{ $rating->username }}</strong></span>
                                            <div class="star-rating mt-2" title="{{$ratingPer}}%">
                                                <div class="back-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <div class="front-stars" style="width: {{$ratingPer}}%">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="my-3">
                                                <p>{{ $rating->comment }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    @if($relatedProducts->isNotEmpty())
    <!-- Other products related to the category Start -->
        <div class="container-fluid py-5">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                <span class="bg-secondary pr-3">{{__('product.related_to_category')}}</span>
            </h2>
            <div class="row px-xl-5">
                @foreach($relatedProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                @php
                                $image = $product->images->first();
                                @endphp
                                @if($image && $image->image_path)
                                    <img class="img-fluid image-Custom" src="{{ Storage::url($image->image_path) }}" alt="{{ $product->name }}" style="height: 250px; width: 100%;">
                                @else
                                    <img src="{{ asset('admin/assets/img/product/noimage.png') }}" alt="{{ $product->name }}" style="height: 250px; width: 100%;" class="img-fluid w-100">
                                @endif
                                @if($product->selling_price < $product->price)
                                <div class="badge bg-danger text-white position-absolute" style="top: 10px; left: 10px; z-index: 1; padding: 5px 10px; border-radius: 3px;">
                                    {{ round((($product->price - $product->selling_price) / $product->price) * 100) }}% {{__('product.discount')}}
                                </div>
                                @endif
                                <div class="product-action">
                                    @if($product->qty >= $product->minqty)
                                    <a class="btn btn-outline-dark btn-square add-to-cart" data-toggle="tooltip" title="{{__('product.add_to_cart')}}"
                                    data-product-id="{{ $product->id }}"
                                    href="javascript:void(0);">
                                    <i class="fa fa-cart-plus"></i></a>
                                    @else
                                    <a class="btn btn-outline-dark btn-square" data-toggle="tooltip" title="{{__('product.unavailable')}}"><i class="fa-solid fa-store-slash"></i></a>
                                    @endif
                                    <a class="btn btn-outline-dark btn-square" onclick="addToWishlist({{ $product->id }})" href="javascript:void(0);" data-toggle="tooltip" title="{{__('product.add_wishlist')}}"><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('get_product_slug', [$product->category->slug, $product->slug]) }}"data-toggle="tooltip" title="{{__('product.view_deatils')}}"><i class="fa-solid fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none" href="{{ route('get_product_slug', [$product->category->slug, $product->slug]) }}" style="display: block; height: 40px; overflow: hidden;">{{ $product->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-1">
                                    <span class="text-muted small">
                                        <a href="{{ route('website.category_slug', $product->category->slug) }}" class="text-muted">{{ $product->category->name }}</a>
                                        @if($product->brand)
                                            | <a href="{{ route('website.shop') }}?brand={{ $product->brand_id }}" class="text-muted">{{ $product->brand->name }}</a>
                                        @endif
                                    </span>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $product->selling_price }} {{__('product.egp')}}</h5>
                                    @if($product->selling_price < $product->price)
                                    <h6 class="text-muted ml-2"><del>{{ $product->price }} {{__('product.egp')}}</del></h6>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <div class="back-stars">
                                        <small class="fa fa-star"></small>
                                        <small class="fa fa-star"></small>
                                        <small class="fa fa-star"></small>
                                        <small class="fa fa-star"></small>
                                        <small class="fa fa-star"></small>
                                        <div class="front-stars" style="width: {{ $product->avgRatingPer }}%">
                                            <small class="fa fa-star"></small>
                                            <small class="fa fa-star"></small>
                                            <small class="fa fa-star"></small>
                                            <small class="fa fa-star"></small>
                                            <small class="fa fa-star"></small>
                                        </div>
                                    </div>
                                    <small class="pt-1"> ({{ $product->product_ratings_count }})</small>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <a href="{{ route('get_product_slug', [$product->category->slug, $product->slug]) }}" class="btn btn-primary">{{__('main.show_details')}} <i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    <!-- Other products related to the category End -->
    @endif


    <!-- You May Also Like Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">{{__('product.may_also_like')}}</span>
        </h2>
        <div class="row px-xl-5">
            @foreach($trendingProducts as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        @php
                        $image = $product->images->first();
                        @endphp
                        @if($image && $image->image_path)
                            <img class="img-fluid image-Custom" src="{{ Storage::url($image->image_path) }}" alt="{{ $product->name }}" style="height: 250px; width: 100%;">
                        @else
                            <img src="{{ asset('admin/assets/img/product/noimage.png') }}" alt="{{ $product->name }}" style="height: 250px; width: 100%;" class="img-fluid w-100">
                        @endif
                        @if($product->selling_price < $product->price)
                                <div class="badge bg-danger text-white position-absolute" style="top: 10px; left: 10px; z-index: 1; padding: 5px 10px; border-radius: 3px;">
                                    {{ round((($product->price - $product->selling_price) / $product->price) * 100) }}% {{__('product.discount')}}
                                </div>
                        @endif
                         <div class="product-action">
                                    @if($product->qty >= $product->minqty)
                                    <a class="btn btn-outline-dark btn-square add-to-cart" data-toggle="tooltip" title="{{__('product.add_to_cart')}}"
                                    data-product-id="{{ $product->id }}"
                                    href="javascript:void(0);">
                                    <i class="fa fa-cart-plus"></i></a>
                                    @else
                                    <a class="btn btn-outline-dark btn-square" data-toggle="tooltip" title="{{__('product.unavailable')}}"><i class="fa-solid fa-store-slash"></i></a>
                                    @endif
                                    <a class="btn btn-outline-dark btn-square" onclick="addToWishlist({{ $product->id }})" href="javascript:void(0);" data-toggle="tooltip" title="{{__('product.add_wishlist')}}"><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('get_product_slug', [$product->category->slug, $product->slug]) }}"data-toggle="tooltip" title="{{__('product.view_deatils')}}"><i class="fa-solid fa-eye"></i></a>
                                </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none" href="{{ route('get_product_slug', [$product->category->slug, $product->slug]) }}" style="display: block; height: 40px; overflow: hidden;">{{ $product->name }}</a>
                        <div class="d-flex align-items-center justify-content-center mt-1">
                            <span class="text-muted small">
                                <a href="{{ route('website.category_slug', $product->category->slug) }}" class="text-muted">{{ $product->category->name }}</a>
                                @if($product->brand)
                                 | <a href="{{ route('website.shop') }}?brand={{ $product->brand_id }}" class="text-muted">{{ $product->brand->name }}</a>
                                @endif
                            </span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>{{ $product->selling_price }} {{__('product.egp')}}</h5>
                            @if($product->selling_price < $product->price)
                            <h6 class="text-muted ml-2"><del>{{ $product->price }} {{__('product.egp')}}</del></h6>
                            @endif
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <div class="back-stars">
                                <small class="fa fa-star"></small>
                                <small class="fa fa-star"></small>
                                <small class="fa fa-star"></small>
                                <small class="fa fa-star"></small>
                                <small class="fa fa-star"></small>
                                <div class="front-stars" style="width: {{ $product->avgRatingPer }}%">
                                    <small class="fa fa-star"></small>
                                    <small class="fa fa-star"></small>
                                    <small class="fa fa-star"></small>
                                    <small class="fa fa-star"></small>
                                    <small class="fa fa-star"></small>
                                </div>
                            </div>
                            <small class="pt-1"> ({{ $product->product_ratings_count }})</small>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <a href="{{ route('get_product_slug', [$product->category->slug, $product->slug]) }}" class="btn btn-primary">{{__('main.show_details')}} <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- You May Also Like End -->

    @section('customjs')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function addtocart() {
            var product_id = $('#product_id').val();
            var qty = $('#qty_value').val();

            console.log('Product ID: ' + product_id + ' | Quantity: ' + qty);

            $.ajax({
                method: 'POST',
                url: "{{ route('product.addToCart') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id,
                    quantity: qty
                },
                success: function(response) {
                    Swal.fire({
                        icon: response.icon,
                        text: response.msg,
                        timer: 2000,
                        timerProgressBar: true,
                    });
                    updateCartCount();
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + error);
                    console.error(xhr.responseText);
                }
            });
        }


        $(document).ready(function () {
            $("#productRatingForm").submit(function (event) {
                event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: $("#productRatingForm").attr("action"),
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            Swal.fire({
                                title: response.title,
                                text: response.message,
                                icon: "success",
                                confirmButtonText: "OK",
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: response.title || "Error",
                                text: response.message || "Something went wrong. Please try again later.",
                                icon: "warning",
                                confirmButtonText: "OK",
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 401) {
                            Swal.fire("Unauthorized!", "You need to log in to submit a review.", "warning");
                        } else if (xhr.status === 422) {
                            let response = xhr.responseJSON;
                            Swal.fire({
                                title: response.title || "Error",
                                text: response.message || "You have already submitted a review for this product.",
                                icon: "warning",
                                confirmButtonText: "OK",
                            });
                        } else {
                            Swal.fire("Error!", "Something went wrong. Please try again later.", "error");
                        }
                    },
                });
            });
        });





        function handleErrors(errors) {
            var fields = ['name', 'email', 'comment', 'rating'];

            fields.forEach(function(field) {
                if (errors[field]) {
                    $("#" + field).addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors[field]);
                } else {
                    $("#" + field).removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                }
            });
        }
    </script>
    @endsection
@endsection
