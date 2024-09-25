@extends('website.layouts.master')
@section('TitlePage' , $page->name)
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">{{$page->name}}</span>
        </h2>
        <div class="row px-xl-5 pb-3">
            <div class="col-sm-12 pb-1">
                <div class="bg-white mb-4" style="padding: 30px;">
                    <div class="d-flex align-items-center mb-4">
                        <h1 class="fa-regular fa-address-card text-primary mr-3"></h1>
                        <h5 class="font-weight-semi-bold m-0">{{$page->name}}</h5>
                    </div>
                    <div class="row d-flex align-items-center">
                        {{-- <div class="col-md-7 p-4">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br> Laboriosam, alias. Soluta, placeat! Blanditiis earum architecto quo, deserunt sequi officiis commodi accusamus neque, porro veritatis nostrum nihil natus! Debitis, blanditiis non.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br> Laboriosam, alias. Soluta, placeat! Blanditiis earum architecto quo, deserunt sequi officiis commodi accusamus neque, porro veritatis nostrum nihil natus! Debitis, blanditiis non.</p>
                        </div>
                        <div class="col-md-5 p-4">
                            <img src="{{asset('website/assets/img/zaky-bakr-brand.png')}}" class="img-fluid img-thumbnail rounded" alt="About Us Image">
                        </div> --}}
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->
@endsection