@extends('website.layouts.master')
@section('TitlePage' , '403 ERROR')
@section('content')
<style>
    /* Style for error page */
    .error-page {
        display: flex;
        justify-content: center;
        align-items: center;
        height: calc(100vh - 95px); /* استبدال 60px بارتفاع Navbar الفعلي */
        
    }
    .error-box h1 {
        font-size: 4em;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* تأثير الظل النصي */

    }

    .error-box h3 {
        font-size: 2em;
    }

    .error-box p {
        font-size: 1.2em;
        margin-bottom: 20px;
    }

</style>
    <div class="error-page">
        <div class="text-center main-wrapper">
            <div class="error-box">
                <h1 class="text-primary">403</h1>
                <h3 class="h2 mb-3"><i class="fas fa-exclamation-circle"></i> Oops! Unauthorized</h3>
                <p class="h4 font-weight-normal">You are not authorized to access this page.</p>
                <a href="{{route('home')}}" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
    </div>

@endsection

