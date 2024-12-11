@foreach ($category->products as $product)
<div class="col-lg-3 col-md-4 col-sm-6 pb-1">
    <div class="product-item bg-light mb-4">
        <div class="product-img position-relative overflow-hidden">
            @php
            $image = $product->images->first();
            @endphp
            @if($image && $image->image_path)
                <img src="{{ Storage::url($image->image_path) }}" alt="{{ $product->name }}" 
                class="img-fluid image-Custom">
            @else
                <img src="{{ asset('admin/assets/img/product/noimage.png') }}" alt="{{ $product->name }}"
                class="img-fluid image-Custom">
            @endif
            <div class="product-action">
                @if($product->qty >= $product->minqty)
                <a class="btn btn-outline-dark btn-square add-to-cart" 
                data-product-id="{{ $product->id }}" 
                href="javascript:void(0);">
                <i class="fa fa-cart-plus"></i></a> 
                @else
                <a class="btn btn-outline-dark btn-square"><i class="fa-solid fa-store-slash"></i></a>
                @endif
                <a class="btn btn-outline-dark btn-square" onclick="addToWishlist({{$product->id}})" href="javascript:void(0);"><i class="far fa-heart"></i></a>
                <a class="btn btn-outline-dark btn-square" href="{{ route('get_product_slug', [$product->category->slug, $product->slug]) }}"><i class="fa-solid fa-eye"></i></a>
            </div>
        </div>
        <div class="text-center py-4">
            <a class="h6 text-decoration-none text-truncate" href="{{ route('get_product_slug', [$product->category->slug, $product->slug]) }}">{{ $product->meta_title }}</a>
            <div class="d-flex align-items-center justify-content-center mt-2">
                <h5>${{ $product->selling_price }}</h5><h6 class="text-muted ml-2"><del>${{ $product->price }}</del></h6>
            </div>
            <div class="d-flex align-items-center justify-content-center mb-3">
                @for ($i = 0; $i < 5; $i++)
                    <small class="fa fa-star {{ $i < $product->rating ? 'text-primary' : 'text-muted' }} mr-1"></small>
                @endfor
                <small>({{ $product->reviews_count }})</small>
            </div>
            <a href="" class="btn btn-primary text-black">Add to cart <i class="fa fa-shopping-cart"></i></a>
        </div>
    </div>
</div>
@endforeach

