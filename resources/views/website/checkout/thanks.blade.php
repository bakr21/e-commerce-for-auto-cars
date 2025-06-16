@extends('website.layouts.master')
@section('TitlePage' , 'Thank you')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 text-center">
                <h1>{{__('checkout.thank_you_for_your_order')}}</h1>
                <p class="lead">{{__('checkout.order_details_are_as_follows:')}}</p>
                <div class="bg-light mt-4 border border-opacity-10">
                    <div class="card-body">
                        <h5 class="card-title">{{__('checkout.order_id')}} #ORD{{ $id }}</h5>
                        <p class="card-text">{{ __('checkout.notes') }}</p>
                        <p class="card-text">{{ __('checkout.total', ['amount' => $order->grand_total]) }}</p>
                        <p class="card-text">{{ __('checkout.invoice_sent') }}</p>
                        <a href="{{ route('website.shop')}}" class="btn btn-primary mt-3">{{ __('checkout.continue_shopping') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
