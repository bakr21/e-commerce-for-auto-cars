@extends('website.layouts.master')
@section('TitlePage' , 'categories')
@section('content')
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-center text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3 ps-3">Categories</span></h2>
    <div class="row px-xl-5">
        
        @foreach ($categories as $category)
        <div class="col-lg-4 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="{{route('website.category_slug' , $category->slug)}}">
                <div class="cat-item d-flex align-items-center mb-4">
                    <div class="overflow-hidden align-content-center" style="width: 650px; height: 250px;">
                        <img class="img-fluid" src="{{ Storage::url($category->image) }}" alt="{{ $category->image }}" style="width: 200px; height: 200px;">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>{{ $category->meta_title }}</h6>
                        <p class="text-body">{{$category->meta_description}} </p>
                        <small class="text-body">{{$category->products_count}} Products</small>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        
    </div>
</div>

@include('website.sections.trend-products')


@endsection