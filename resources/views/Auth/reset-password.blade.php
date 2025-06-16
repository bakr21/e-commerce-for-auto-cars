@extends('website.layouts.master')
@section('TitlePage', __('reset-password.reset_password'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
            <div class="shadow-sm p-5 bg-body rounded">
                <h4 class="modal-title pb-3">{{ __('reset-password.reset_password') }}</h4>
                <p class="text-muted mb-4">{{ __('reset-password.enter_new_password') }}</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email">{{ __('reset-password.email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus readonly>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('reset-password.password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('reset-password.password') }}">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">{{ __('reset-password.confirm_password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('reset-password.confirm_password') }}">
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-dark btn-block btn-lg">
                            {{ __('reset-password.reset_password') }}
                        </button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="fw-bold hover-a">{{ __('reset-password.back_to_login') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
