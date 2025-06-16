@extends('website.layouts.master')
@section('TitlePage' , '429 ERROR')
@section('content')
<style>
    /* Style for error page */
    .error-page {
        display: flex;
        justify-content: center;
        align-items: center;
        height: calc(100vh - 95px);
    }
    .error-box h1 {
        font-size: 4em;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .error-box h3 {
        font-size: 2em;
    }

    .error-box p {
        font-size: 1.2em;
        margin-bottom: 20px;
    }

    .error-image {
        max-width: 300px;
        margin-bottom: 20px;
    }
</style>
    <div class="error-page">
        <div class="text-center main-wrapper">
            <div class="error-box">
                <h1 class="text-primary">429</h1>
                <h3 class="h2 mb-3"><i class="fas fa-exclamation-circle"></i> {{__('errors.too_many_requests')}}</h3>
                <p class="h4 font-weight-normal">{{__('errors.too_many_requests_message')}}</p>
                <a href="{{route('home')}}" class="btn btn-primary">{{__('errors.back_to_home')}}</a>
            </div>
        </div>
    </div>
@endsection
