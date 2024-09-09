@extends('admin.layouts.master')
@section('TitlePage', 'catdasn')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Product Details</h4>
            <h6>Full details of a product</h6>
        </div>
        <div class="page-btn">
            <a href="{{route('products.index')}}" class="btn btn-added">
                <img src="{{asset('admin/assets/img/icons/reverse.svg')}}" alt="img" class="me-1">Product List
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="bar-code-view">
                        <img src="{{asset('admin/assets/img/barcode1.png')}}" alt="barcode">
                        <a class="printimg">
                            <img src="{{asset('admin/assets/img/icons/printer.svg')}}" alt="print">
                        </a>
                    </div>
                    <div class="productdetails">
                        <ul class="product-bar">
                            <li>
                                <h4>Product</h4>
                                <h6>{{$product->name}}</h6>
                            </li>
                            <li>
                                <h4>Category</h4>
                                <h6>{{$product->category->name}}</h6>
                            </li>
                            <li>
                                <h4>Short Description</h4>
                                <h6>{{$product->short_description}}</h6>
                            </li>
                            <li>
                                <h4>Sub Category</h4>
                                <h6>None</h6>
                            </li>
                            <li>
                                <h4>Brand</h4>
                                <h6>{{$product->category->name}}</h6>
                            </li>

                            <li>
                                <h4>Unit</h4>
                                <h6>Piece</h6>
                            </li>
                            <li>
                                <h4>SKU</h4>
                                <h6>PT0001</h6>
                            </li>
                            <li>
                                <h4>Minimum Qty</h4>
                                <h6>5</h6>
                            </li>
                            <li>
                                <h4>Quantity</h4>
                                <h6>{{$product->qty}}</h6>
                            </li>
                            <li>
                                <h4>Tax</h4>
                                <h6>{{$product->tax}}</h6>
                            </li>
                            <li>
                                <h4>Sell Price</h4>
                                <h6>{{$product->selling_price}}</h6>
                            </li>
                            <li>
                                <h4>Price</h4>
                                <h6>{{$product->price}}</h6>
                            </li>
                            <li>
                                <h4>Profit</h4>
                                <h6>{{$product->selling_price - $product->price }}</h6>
                            </li>
                            <li>
                                <h4>Status</h4>
                                <h6>
                                    @if($product->status == 1)
                                    <span class="badge bg-success">show</span>
                                    @else
                                    <span class="badge bg-danger">don't show</span>
                                    @endif
                                </h6>
                            </li>
                            <li>
                                <h4>Trend</h4>
                                <h6>
                                    @if($product->trend == 1)
                                    <span class="badge bg-success">show</span>
                                    @else
                                    <span class="badge bg-danger">don't show</span>
                                    @endif
                                </h6>
                            </li>
                            <li>
                                <h4>Description</h4>
                                <h6>{{$product->description}}</h6>
                            </li>
                        </ul>
                    </div>
                    <div class="page-title">
                        <h4 class="mt-3 mb-3">SEO Product</h4>
                    </div>
                    <div class="productdetails">
                        <ul class="product-bar">
                            <li>
                                <h4>Slug</h4>
                                <h6>{{$product->slug}}</h6>
                            </li>
                            <li>
                                <h4>Meta Title</h4>
                                <h6>{{$product->meta_title}}</h6>
                            </li>
                            <li>
                                <h4>Meta Description</h4>
                                <h6>{{$product->meta_description}}</h6>
                            </li>
                            <li>
                                <h4>Meta Keywords</h4>
                                <h6>{{$product->meta_keywords}}</h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="slider-product-details">
                        <div class="owl-carousel owl-theme product-slide">
                            @if($product->images->isEmpty())
                            <p>No images available for this product.</p>
                            @else
                                @foreach($product->images as $image)
                                @if($image->image_path)

                                <div class="slider-product">

                                    <img src="{{ Storage::url($image->image_path)}}" alt="{{ $product->name }}"
                                        style=" height: 200px;" class="rounded mx-auto img-thumbnail">
                                    <h4>{{ $product->name }}</h4>
                                    <h6>{{ round(Storage::size($image->image_path) / 1048576, 2) }} MB</h6>
                                </div>

                                @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
