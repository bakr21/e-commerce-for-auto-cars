@extends('website.layouts.master')
@section('TitlePage', __('reset-password.forgot_password'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
            <div class="shadow-sm p-5 bg-body rounded">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <h4 class="modal-title pb-3">{{ __('reset-password.forgot_password') }}</h4>
                <p class="text-muted mb-4">{{ __('reset-password.enter_email') }}</p>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">{{ __('reset-password.email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('reset-password.email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-dark btn-block btn-lg">
                            {{ __('reset-password.send_reset_link') }}
                        </button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    {{ __('reset-password.remember_password') }} <a href="{{ route('login') }}" class="fw-bold hover-a">{{ __('reset-password.login_here') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
