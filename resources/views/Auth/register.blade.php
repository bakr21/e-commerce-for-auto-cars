@extends('website.layouts.master')
@section('TitlePage', __('register.register'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="shadow-sm p-5 bg-body rounded">
                <form action="{{route('register.save')}}" method="POST">
                    @csrf
                    <h4 class="modal-title pb-3">{{ __('register.create_your_account') }}</h4>
                    <p class="text-muted mb-4">{{ __('register.join_us_today') }}</p>
                    <div class="form-group">
                        <label>{{ __('register.name') }}</label>
                        <input type="text" class="form-control" name="name" placeholder="{{ __('register.name') }}" value="{{old('name')}}">
                        @error('name')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('register.email') }}</label>
                        <input type="text" class="form-control" name="email" placeholder="{{ __('register.email') }}" value="{{old('email')}}">
                        @error('email')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('address.address') }}</label>
                        <textarea class="form-control" name="address" placeholder="{{ __('address.enter_address') }}">{{old('address')}}</textarea>
                        @error('address')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('address.region') }}</label>
                        <select class="form-control js-example-basic-single select2" name="region">
                            <option selected="selected" disabled>{{ __('address.select_region') }}</option>
                            @if(isset($regions))
                                @foreach($regions as $region)
                                    <option value="{{ $region->code }}" {{ old('region') == $region->code ? 'selected' : '' }}>
                                        {{ app()->getLocale() == 'ar' ? $region->name_ar : $region->name }} - Egypt
                                    </option>
                                @endforeach
                            @else
                                {{-- Fallback options if regions are not loaded --}}
                                <option value="cairo">Cairo - Egypt</option>
                                <option value="giza">Giza - Egypt</option>
                                <option value="alex">Alexandria - Egypt</option>
                            @endif
                        </select>
                        @error('region')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('register.password') }}</label>
                        <div class="pass-group">
                            <input type="password" name="password" class="form-control" placeholder="{{ __('register.password') }}">
                        </div>
                        @error('password')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('register.confirm_password') }}</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="{{ __('register.confirm_password') }}" />
                    </div>
                    <div class="form-group small">
                        <a href="{{ route('password.request') }}" class="forgot-link">{{ __('login.forgot_password') }}</a>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block btn-lg" value="Register">{{ __('register.register') }}</button>
                </form>
                <div class="text-center mt-3">{{ __('register.already_have_account') }} <a href="{{ route('login')}}" class="fw-bold hover-a">{{ __('register.login_here') }}</a></div>
            </div>
        </div>
    </div>
</div>

@endsection
