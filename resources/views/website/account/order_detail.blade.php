@extends('website.layouts.master')
@section('TitlePage' , 'Order')
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('home')}}">Home</a>
                <a class="breadcrumb-item text-dark" href="{{ route('website.account.orders')}}">Orders</a>
                <span class="breadcrumb-item active">Order Detail</span>
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

                <div class="card-body pb-3">
                    <!-- Info -->
                    <div class="card card-sm">
                        <div class="card-body bg-light mb-3">
                            <div class="row">
                                <div class="col-6 col-lg-3">
                                    <!-- Heading -->
                                    <h6 class="heading-xxxs text-muted">Order No:</h6>
                                    <!-- Text -->
                                    <p class="mb-lg-0 fs-sm fw-bold">
                                    {{ $order->id}}
                                    </p>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <!-- Heading -->
                                    <h6 class="heading-xxxs text-muted">Shipped date:</h6>
                                    <!-- Text -->
                                    <p class="mb-lg-0 fs-sm fw-bold">
                                        <time datetime="2019-10-01">
                                            {{ \Carbon\Carbon::parse($order->creates_at)->format('d M, Y - D')}}
                                        </time>
                                    </p>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <!-- Heading -->
                                    <h6 class="heading-xxxs text-muted">Status:</h6>
                                    <!-- Text -->
                                    <p class="mb-0 fs-sm fw-bold">
                                        @if($order->status == 'delivered')
                                        <span class="badge bg-success">Delivered</span>
                                        @elseif ($order->status == 'shipped')
                                        <span class="badge bg-info">Shipped</span>
                                        @elseif ($order->status == 'pending')
                                        <span class="badge bg-danger">Pending</span>
                                        @else 
                                        <span class="badge bg-danger fw-bold">Cancelled</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-6 col-lg-3">
                                    <!-- Heading -->
                                    <h6 class="heading-xxxs text-muted">Order Amount:</h6>
                                    <!-- Text -->
                                    <p class="mb-0 fs-sm fw-bold">
                                    {{$order->grand_total}} EGP
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer p-3">

                    <!-- Heading -->
                    <h6 class="mb-7 h5 mt-4">Order Items (3)</h6>

                    <!-- Divider -->
                    <hr class="my-3">

                    <!-- List group -->
                    <ul>
                        @forelse ($orderItems as $orderItem)
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-4 col-md-3 col-xl-2">
                                    <!-- Image -->
                                    @php
                                        $product = $orderItem->product;
                                        $image = $product->images->first(); 
                                    @endphp

                                        @if($image && $image->image_path)
                                            <a href="product.html"><img src="{{ Storage::url($image->image_path) }}" alt="{{$orderItem->name}}" class="img-fluid"></a>
                                        @else
                                            <img src="{{asset('admin/assets/img/product/noimage.png')}}" alt="{{ $orderItem->name }}"
                                            class="img-fluid image-Custom">
                                        @endif
                                </div>
                                <div class="col">
                                    <!-- Title -->
                                    <p class="mb-4 fs-sm fw-bold">
                                        <a class="text-body" href="product.html">{{$orderItem->name}} x {{$orderItem->qty}}</a> <br>
                                        <span class="text-muted">{{$orderItem->total}} EGP</span>
                                    </p>
                                </div>
                            </div>
                        </li>
                            
                        @empty
                            
                        @endforelse
                    </ul>
                </div>                      
            </div>
            
            <div class="card card-lg mb-5 mt-3">
                <div class="card-body">
                    <!-- Heading -->
                    <h6 class="mt-0 mb-3 h5">Order Total</h6>

                    <!-- List group -->
                    <ul>
                        <li class="list-group-item d-flex">
                            <span>Subtotal</span>
                            <span class="ms-auto">{{$order->subtotal}} EGP</span>
                        </li>
                        <li class="list-group-item d-flex">
                            <span>Discount {{ (!empty($order->code)) ? '('.$order->coupon_code.')' : ''}}</span>
                            <span class="ms-auto">0.00 EGP</span>
                        </li>
                        <li class="list-group-item d-flex">
                            <span>Shipping</span>
                            <span class="ms-auto">{{$order->shipping}} EGP</span>
                        </li>
                        <li class="list-group-item d-flex fs-lg fw-bold">
                            <span>Total</span>
                            <span class="ms-auto">{{$order->grand_total}} EGP</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
