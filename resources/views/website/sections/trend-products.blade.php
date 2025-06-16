<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4" data-aos="fade-down">
        <span class="bg-secondary pr-3">{{__('home.featured_products')}}</span>
    </h2>
    <div class="row px-xl-5" id="featured-products">
        @foreach ($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    @php
                    $image = $product->images->first();
                    @endphp
                    @if($image && $image->image_path)
                        <img src="{{ Storage::url($image->image_path) }}" alt="{{ $product->name }}"
                        class="img-fluid image-Custom" style="width: 100%; height: 250px; object-fit: contain;">
                    @else
                        <img src="{{asset('admin/assets/img/product/noimage.png')}}" alt="{{ $product->name }}"
                        class="img-fluid image-Custom" style="width: 100%; height: 250px; object-fit: contain;">
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
                        <a class="btn btn-outline-dark btn-square" onclick="addToWishlist({{$product->id}})" href="javascript:void(0);" data-toggle="tooltip" title="{{__('product.add_wishlist')}}"><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href="{{ route('get_product_slug', [$product->category->slug, $product->slug]) }}" data-toggle="tooltip" title="{{__('product.view_deatils')}}"><i class="fa-solid fa-eye"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none" href="{{route('get_product_slug',[$product->category->slug,$product->slug])}}" style="display: block; height: 40px; overflow: hidden;">{{ $product->name }}</a>
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
                    <div class="d-flex align-items-center justify-content-center mt-3">
                        <a href="{{ route('get_product_slug', [$product->category->slug, $product->slug]) }}" class="btn btn-primary">{{__('main.show_details')}} <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>


