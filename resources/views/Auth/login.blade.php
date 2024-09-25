@extends('website.layouts.master')
@section('TitlePage' , 'Home')
@section('content')


        <div class="container">
            <div class="login-form shadow-sm p-5 bg-body rounded">    
                <form action="{{route('login.action')}}" method="POST">
                    @csrf
                    <h4 class="modal-title pb-3">Login to Your Account</h4>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Enter your email address"  value="{{old('email')}}">
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" >
                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input"
                            value="remember-me" name="remember" id="remember" checked  required>
                        <label class="form-check-label"
                            for="remember">Remember me</label>
                    </div>
                    <div class="form-group small">
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div> 
                    <input type="submit" class="btn btn-dark btn-block btn-lg" value="Login">              
                </form>			
                <div class="text-center mt-3">Don't have an account? <a href="{{ route('register')}}" class="fw-bold hover-a" >Sign up</a></div>
            </div>
        </div>
        
@endsection