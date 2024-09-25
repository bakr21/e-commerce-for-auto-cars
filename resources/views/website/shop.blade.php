@extends('website.layouts.master')
@section('TitlePage' , 'Shop')
@section('content')

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shop List</span>
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
            
            <div class="col-lg-3 col-md-4">
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Filter by category</span>
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
                                    <a onclick="window.location.href='{{ route('website.shop', $category->slug) }}'" style="cursor: pointer;" class="nav-item nav-link text-muted d-flex justify-content-between align-items-center">
                                        {{ $category->name }}
                                        <span class="badge border font-weight-normal text-muted">{{ $category->products_count }}</span>
                                    </a>
                                @endif
                            </div>
                        @endforeach                                                                         
                    </div>
                @endif
                </div>        
                <!-- category End -->

            <!-- brand Start -->
            @if ($brands->isNotEmpty())
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                brand</span></h5>
            <div class="bg-light p-4 mb-30"> 
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <label>All brands</label>
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
        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
            price</span></h5>
        <div class="bg-light p-4 mb-30">
            <input type="text" class="js-range-slider" name="my_range" value="" />
        </div>

        </div>
        <!-- Shop Sidebar End -->

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            {{-- <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button> --}}
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <select name="sort" id="sort" class="form-control btn btn-sm btn-light">
                                    <option value="latest" {{($sort == 'latest') ? 'selected' : ''}}>Sorting : Latest</option>
                                    <option value="price_desc" {{($sort == 'price_desc') ? 'selected' : ''}}>Sorting : Price High</option>
                                    <option value="price_asc" {{($sort == 'price_asc') ? 'selected' : ''}}>Sorting : Price Low</option>
                                </select>
                            </div>
                            {{-- link pagination --}}
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                    data-toggle="dropdown">Showing</button>
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
                                alt="{{ $product->name }}">
                            @else
                            <img src="{{asset('admin/assets/img/product/noimage.png')}}" alt="{{ $product->name }}"
                                style="height: 250px; width: 100%;" class="img-fluid w-100">
                            @endif
                            <div class="product-action">
                                @if($product->qty >= $product->minqty)
                                <a class="btn btn-outline-dark btn-square" onclick="addtocart()" href="javascript:void(0);"><i class="fa fa-shopping-cart"></i></a>
                                <input type="hidden" id="product_id" name="product_id" value="{{$product->id}}" />
                                @else
                                <a class="btn btn-outline-dark btn-square"><i class="fa-solid fa-store-slash"></i></a>
                                @endif
                                <a class="btn btn-outline-dark btn-square" onclick="addToWishlist({{$product->id}})" href="javascript:void(0);"><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{ route('get_product_slug', [$product->category->slug, $product->slug]) }}"><i class="fa-solid fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="{{ route('get_product_slug', [$product->category->slug, $product->slug]) }}">{{ $product->name }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{ $product->selling_price }} EGP</h5>
                                @if ($product->price > 150)
                                    <h6 class="text-muted ml-2"><del>{{ $product->price }} EGP</del></h6>
                                @endif
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                
                <div class="col-12">
                    <nav>
                        <ul class="pagination justify-content-center">
                            
                            {{ $products->withQueryString()->links() }}
                        </ul>
                        <p class="text-end">All Products : {{$productsCount}}</p>
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
                Swal.fire(response.msg);
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
                console.error(xhr.responseText);
            }
        });
    }

    
    rangeSlider = $(".js-range-slider").ionRangeSlider({
    type: 'double',
    min: 0,
    max: {{ $price}},
    from: {{ $priceMin}} ,
    step: 10,
    to: {{ $priceMax }},
    skin: "round", 
    prettify_enabled: true,
    prettify_separator: ",",
    max_postfix: "+",
    prefix: "EGP ",
    grid: true,
    grid_num: 5,
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

    function apply_filters() {
        var brands = [];
        $(".brand-label").each(function() {
            if ($(this).is(":checked") == true) {
                brands.push($(this).val());
            }
        });

        var url ='{{ url()->current() }}?';
        // price
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
