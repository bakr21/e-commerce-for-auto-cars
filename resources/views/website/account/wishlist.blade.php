@extends('website.layouts.master')
@section('TitlePage' , 'Wishlist')
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('home')}}">Home</a>
                <span class="breadcrumb-item active">Profile</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-3 col-md-4">
            @include('website.account.account-panel')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                </div>
                @forelse ($wishlists as $wishlist)
                    <div class="card-body p-4">
                        <div class="d-sm-flex justify-content-between mt-lg-4 mb-2 pb-3 pb-sm-2 border-bottom">
                            <div class="d-block d-sm-flex align-items-start text-center text-sm-start">
                                <a class="d-block flex-shrink-0 mx-auto me-sm-4 pe-2" href="{{ route('get_product_slug', [$wishlist->product->category->slug, $wishlist->product->slug]) }}" style="width: 10rem;">
                                    @php
                                    $image = $wishlist->product->images->first(); 
                                    @endphp
                                    @if($image && $image->image_path)
                                        <img src="{{ Storage::url($image->image_path) }}" alt="..." class="img-fluid">
                                    @else
                                        <img src="{{asset('admin/assets/img/product/noimage.png')}}" alt="{{ $wishlist->product->name }}"
                                        class="img-fluid">
                                    @endif
                                </a>
                                <div class="pt-2">
                                    <h4 class="product-title fs-base mb-2"><a href="{{ route('get_product_slug', [$wishlist->product->category->slug, $wishlist->product->slug]) }}">{{ $wishlist->product->name}}</a></h4>                                        
                                    <div class="fs-lg text-accent pt-2">{{  $wishlist->product->selling_price}} EGP<del class="text-muted ml-2">{{ $wishlist->product->price}} EGP</del></div>

                                </div>
                            </div>
                            <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                <button onclick="removeProductFromWishlist({{$wishlist->product_id}})" class="btn btn-outline-danger btn-sm" type="button"><i class="fas fa-trash-alt me-2"></i>Remove</button>
                            </div>
                        </div>  
                    </div>
                @empty
                    <h3 class="p-4">Your wishlist is empty !</h3>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
@section('customjs')
<script>
    function removeProductFromWishlist(id) {
        $.ajax({
            url: '{{ route('website.account.removeProductFromWishlist') }}',
            type: 'POST',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    Swal.fire({
                    icon: 'success',
                    title: 'Removed from Wishlist',
                    timer: 5000,
                    timerProgressBar: true,
                    text: response.message,
                    }).then(() => {
                        location.reload(); 
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                            icon: 'error',
                            title: 'Error deleting the product from wishlist ',
                            text: response.message,
                        });
            }
        });
        }   
</script>

@endsection
