@extends('website.layouts.master')

@section('TitlePage', $category->slug . ' category')

@section('content')
<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Category</span>
    </h2>
    <div class="row px-xl-5 pb-3 align-items-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ Storage::url($category->image) }}" class="img-fluid rounded-start image-category" alt="{{ $category->slug }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->slug }}</h5>
                            <p class="card-text">{{ $category->description }}</p>
                            <p class="card-text"><span class="fw-bold">Products related:</span> <small class="text-muted">{{ $category->products_count }} products</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="{{ asset('website/assets/img/offer-2-n.jpg') }}" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Products related</span>
    </h2>
    <div class="row px-xl-5">
        
            @include('website.category-products')
    </div>
</div>


@endsection
