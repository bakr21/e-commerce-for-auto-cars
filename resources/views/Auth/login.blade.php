@extends('website.layouts.master')
@section('TitlePage', __('login.login'))
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="shadow-sm p-5 bg-body rounded">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('login.action') }}" method="POST">
                    @csrf
                    <h4 class="modal-title pb-3">{{ __('login.welcome_back') }}</h4>
                    <p class="text-muted mb-4">{{ __('login.sign_in_to_continue') }}</p>

                    <div class="form-group">
                        <label for="email">{{ __('login.email') }}</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="{{ __('login.email') }}" value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('login.password') }}</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="{{ __('login.password') }}">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">{{ __('login.remember_me') }}</label>
                    </div>

                    <div class="form-group mb-4">
                        <a href="{{ route('password.request') }}" class="forgot-link btn-link">{{ __('login.forgot_password') }}</a>
                    </div>

                    <button type="submit" class="btn btn-dark btn-block btn-lg">{{ __('login.login') }}</button>
                </form>

                <div class="text-center mt-3">
                    {{ __('login.dont_have_account') }} <a href="{{ route('register') }}" class="fw-bold hover-a">{{ __('login.create_account') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
