@extends('website.layouts.master')
@section('TitlePage' , 'Shop')
@section('content')

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">{{__('breadcrumb.home')}}</a>
                <a class="breadcrumb-item text-dark" href="#">{{__('breadcrumb.shop')}}</a>
                <span class="breadcrumb-item active">{{__('breadcrumb.shop_list')}}</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
            <!-- category Start -->

        <div class="col-lg-3 col-md-4 order-2 order-md-1">
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">{{__('shop.filter_by_category')}}</span>
            </h5>
            <div class="bg-light p-3 mb-30">
                @if ($categories->isNotEmpty())
                    <div class="accordion accordion-flush" id="accordionExample">
                        @foreach ($categories as $category)
                            <div class="accordion-item">
                                @if(isset($category->sub_category) && $category->sub_category->isNotEmpty())
                                    <h2 class="accordion-header" id="heading{{ $category->id }}">
                                        <button class="accordion-button collapsed d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}" aria-expanded="false" aria-controls="collapse{{ $category->id }}">
                                            {{ $category->name }}
                                            <span class="badge border font-weight-normal text-muted">{{ $category->products_count }}</span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $category->id }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="navbar-nav">
                                                @foreach ($category->sub_category as $sub_category)
                                                    <a href="{{ route('products.index', ['category' => $sub_category->id]) }}" class="nav-item nav-link">
                                                        {{ $sub_category->name }}
                                                        <span class="badge border font-weight-normal text-muted">{{ $sub_category->products_count }}</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                <a onclick="window.location.href='{{ route('website.shop', $category->slug) }}'"
                                    style="cursor: pointer;"
                                    class="nav-item nav-link {{ request()->is('*/shop/'.$category->slug) ? 'text-primary' : 'text-muted' }} d-flex justify-content-between align-items-center text-primary">
                                        {{ $category->name }}
                                    <span class="badge border font-weight-normal text-muted">{{ $category->products_count }}</span>
                                </a>



                                    @endif
                                </div>
                                @endforeach
                                <a class="nav-item nav-link text-muted d-flex  align-items-center text-primary" href="{{route('website.shop')}}"><i class="fa-solid fa-filter-circle-xmark"></i>  {{__('shop.remove_filter')}}</a>
                    </div>
                @endif
            </div>
                <!-- category End -->

            <!-- brand Start -->
            @if ($brands->isNotEmpty())
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">{{__('shop.filter_by_brand')}}</span></h5>
            <div class="bg-light p-4 mb-30">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <label>{{__('shop.all_brands')}}</label>
                    <span class="badge border font-weight-normal text-muted">{{ $brandCount }}</span>
                </div>
                @foreach ($brands as $brand)
                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                    <input {{ (in_array($brand->id,$brandsArray)) ? 'checked' : ''}} type="checkbox" name="brand[]" value="{{ $brand->id }}" class="custom-control-input brand-label" id="brand-{{ $brand->id }}">
                    <label class="custom-control-label" for="brand-{{ $brand->id }}"  style="cursor: pointer;">
                        {{ $brand->name }}
                    </label>
                    <span class="badge border font-weight-normal text-muted">{{ $brand->products_count }}</span>
                </div>
                @endforeach

            </div>
            @endif
            <!-- brand End -->

        <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">{{__('shop.filter_by_price')}}</span></h5>
            <div class="bg-light p-4 mb-30">
                <input type="text" class="js-range-slider" name="my_range" value="" />
            </div>

        </div>
        <!-- Shop Sidebar End -->

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8 order-1 order-md-2">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <a class="btn btn-sm btn-light mr-2" href="{{route('website.shop')}}"><i class="fa-solid fa-filter-circle-xmark"></i></a>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <select name="sort" id="sort" class="form-control btn btn-sm btn-light">
                                    <option value="latest" {{($sort == 'latest') ? 'selected' : ''}}>{{__('shop.sort_by')}} : {{__('shop.Latest')}}</option>
                                    <option value="price_desc" {{($sort == 'price_desc') ? 'selected' : ''}}>{{__('shop.sort_by')}} : {{__('shop.price_highest')}}</option>
                                    <option value="price_asc" {{($sort == 'price_asc') ? 'selected' : ''}}>{{__('shop.sort_by')}} : {{__('shop.price_lowest')}}</option>
                                </select>
                            </div>
                            {{-- link pagination --}}
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                    data-toggle="dropdown">{{__('shop.Showing')}}</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">10</a>
                                    <a class="dropdown-item" href="#">20</a>
                                    <a class="dropdown-item" href="#">30</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    @php
                                    $image = $product->images->first();
                                    @endphp
                                    @if($image && $image->image_path)
                                    <img class="img-fluid image-Custom" src="{{ Storage::url($image->image_path) }}"
                                        alt="{{ $product->name }}" style="height: 250px; width: 100%;">
                                    @else
                                    <img src="{{asset('admin/assets/img/product/noimage.png')}}" alt="{{ $product->name }}"
                                        style="height: 250px; width: 100%;" class="img-fluid w-100">
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
                @else
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">{{ __('shop.search') }}</h4>
                        <h5 class="text-muted">
                            {{ __('shop.contact_line') }}
                            <a href="{{ url('page/contact-us') }}" target="_blank" class="text-primary">
                                {{ __('shop.here') }} <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.8rem;"></i>
                            </a>
                            {{ __('shop.or_hotline') }}
                        </h5>

                    </div>
                @endif

                <div class="col-12">
                    <nav>
                        <ul class="pagination justify-content-center">
                            {{ $products->withQueryString()->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
</div>
    <!-- Shop End -->

@endsection

@section('customjs')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });




    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    rangeSlider = $(".js-range-slider").ionRangeSlider({
    type: 'double',
    min: 100,
    max: {{ $price}},
    from: {{ $priceMin}} ,
    step: 100,
    to: {{ $priceMax }},
    skin: "round",
    prettify_enabled: true,
    prettify_separator: ",",
    max_postfix: "+",
    prefix: "EGP ",
    grid: true,
    grid_num: 3,
    onFinish: function(){
        apply_filters()
    }
    });

    var slider = $(".js-range-slider").data('ionRangeSlider');

    $(".brand-label").change(function() {
        apply_filters();
    });

    $("#sort").change(function() {
        apply_filters();
    });

    // Add to cart functionality
    $(document).on('click', '.add-to-cart', function(e) {
        e.preventDefault();
        var productId = $(this).data('product-id');

        $.ajax({
            method: 'POST',
            url: "{{ route('product.addToCart') }}",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: productId,
                quantity: 1
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
    });

    // Add to wishlist functionality
    function addToWishlist(productId) {
        $.ajax({
            type: "POST",
            url: "{{ route('website.addToWishlist') }}",
            data: {
                product_id: productId,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    updateWishlistCount();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    window.location.href = "{{ route('login') }}";
                }
            }
        });
    }

    // Update cart count
    function updateCartCount() {
        $.ajax({
            url: "{{ route('cart.count') }}",
            type: "GET",
            success: function(response) {
                $('#cart-count').text(response.count);
            }
        });
    }

    // Update wishlist count
    function updateWishlistCount() {
        $.ajax({
            url: "{{ route('wishlist.count') }}",
            type: "GET",
            success: function(response) {
                $('#wishlist-count').text(response.count);
            }
        });
    }

    function apply_filters() {
        var brands = [];
        $(".brand-label").each(function() {
            if ($(this).is(":checked") == true) {
                brands.push($(this).val());
            }
        });

        var url ='{{ url()->current() }}?';
        // price
        var priceMin = slider.result.from;
        if (priceMin < 10) {
            priceMin = 10;  // تأكد من أن السعر الأدنى دائمًا 10
        }
        url += '&price_min='+slider.result.from+'&price_max='+slider.result.to;

        // brands
        if (brands.length > 0) {
            url+= '&brand='+brands.toString();
        }

        var keyword = $('#search').val();
        if (keyword.length > 0) {
            url += '&search='+keyword;
        }

        // sort
        url += '&sort='+$("#sort").val();
        window.location.href = url;
    }
</script>
@endsection
