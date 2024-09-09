@extends('website.layouts.master')
@section('TitlePage' , 'thank you')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 text-center">
                <h1>Thank You for Your Order!</h1>
                <p class="lead">We appreciate your business. Your order details are as follows:</p>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Order #{{ $id }}</h5>
                        <p class="card-text">Notes: The order will be received after 4 days.</p>
                        <p class="card-text">Total: {{ $order->grand_total }} EGP</p>
                        <p class="card-text">We have sent you the invoice details to your email.</p>
                        <a href="{{ route('website.shop')}}" class="btn btn-primary mt-3">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection