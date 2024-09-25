@extends('website.layouts.master')
@section('TitlePage' , 'Register ')
@section('content')
        <div class="container w-50">
            <div class="login-form shadow-sm p-5 bg-body rounded">    
                <form action="{{route('register.save')}}" method="POST">
                    @csrf
                    <h4 class="modal-title pb-3">Register Now</h4>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your full name" value="{{old('name')}}">
                        @error('name')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter your email address" value="{{old('email')}}">
                        @error('email')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="address"
                        placeholder="Enter Address">{{old('address')}}</textarea>
                    @error('address')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label >Region</label>
                        <select class="form-control js-example-basic-single select2" name="region">
                            <option selected="selected">Select Region - Egypt</option>
                            <option value="alex">Alexandria - Egypt</option>
                            <option value="damn">Dam - Egypt</option>
                            <option value="dand">Dandara - Egypt</option>
                        </select>
                        @error('region')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="pass-group">
                            <input type="password" name="password"  class="form-control" placeholder="Enter your password">
                        </div>
                        @error('password')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" />
                    </div>
                    <div class="form-group small">
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div> 
                    <button type="submit" class="btn btn-dark btn-block btn-lg" value="Register">Register</button>
                </form>			
                
                <div class="text-center mt-3">Already have an account? <a href="{{ route('login')}}" class="fw-bold hover-a">Login Now</a></div>
            </div>
        </div>

@endsection
{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Login - Pos admin template</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin/assets/img/favicon.jpg')}}">

    <link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}">

    <link rel="stylesheet" href="{{asset('admin/assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/dataTables.bootstrap4.min.css')}}">

    <link rel="stylesheet" href="{{asset('admin/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="{{asset('admin/assets/img/logo.png')}}" alt="img">
                        </div>
                        
                        <div class="login-userheading">
                            <h3>Create an Account</h3>
                            <h4>Continue where you left off</h4>
                        </div>
                        <form action="{{route('register.save')}}" method="POST">
                            @csrf
                        <div class="form-login">
                            <label>Full Name</label>
                            <div class="form-addons">
                                <input type="text" name="name" placeholder="Enter your full name" value="{{old('name')}}">
                                <img src="{{asset('admin/assets/img/icons/users1.svg')}}" alt="img">
                            </div> 
                            @error('name')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-login">
                            <label>Email</label>
                            <div class="form-addons">
                                <input type="text"  name="email" placeholder="Enter your email address" value="{{old('email')}}">
                                <img src="{{asset('admin/assets/img/icons/mail.svg')}}" alt="img">
                            </div>
                            @error('email')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-login">
                            <label>Address</label>
                            <textarea class="form-control" name="address"
                                placeholder="Enter Address">{{old('address')}}</textarea>
                            @error('address')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-login">
                            <label >Region</label>
                            <select class="form-control js-example-basic-single select2" name="region">
                                <option selected="selected">Select Region - Egypt</option>
                                <option value="alex">Alexandria - Egypt</option>
                                <option value="damn">Dam - Egypt</option>
                                <option value="dand">Dandara - Egypt</option>
                            </select>
                            @error('region')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-login">
                            <label>Password</label>
                            <div class="pass-group">
                                <input type="password" name="password" class="pass-input" placeholder="Enter your password">
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                            @error('password')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-login">
                            <label >Confirm Password</label>
                            <input type="password" name="password_confirmation" placeholder="Confirm password" />
                        </div>
                        <div class="form-login">
                            <button type="submit" class="btn btn-login">Sign Up</button>
                        </div>
                    </form>
                        <div class="signinform text-center">
                            <h4>Already a user? <a href="{{route('login')}}" class="hover-a">Sign In</a></h4>
                        </div>
                        <div class="form-setlogin">
                            <h4>Or sign up with</h4>
                        </div>
                        <div class="form-sociallink">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);">
                                        <img src="{{asset('admin/assets/img/icons/google.png')}}" class="me-2" alt="google">
                                        Sign Up using Google
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <img src="{{asset('admin/assets/img/icons/facebook.png')}}" class="me-2" alt="google">
                                        Sign Up using Facebook
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="login-img">
                    <img src="{{asset('admin/assets/img/login.jpg')}}" alt="img">
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('admin/assets/js/jquery-3.6.0.min.js')}}"></script>

    <script src="{{asset('admin/assets/js/feather.min.js')}}"></script>

    <script src="{{asset('admin/assets/js/jquery.slimscroll.min.js')}}"></script>

    <script src="{{asset('admin/assets/js/bootstrap.bundle.min.js')}}"></script>


    <script src="{{asset('admin/assets/js/script.js')}}"></script>

	<script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
	<script src="{{asset('admin/assets/plugins/select2/js/custom-select.js')}}"></script>

    <script src="{{asset('admin/assets/plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/sweetalert/sweetalerts.min.js')}}"></script>
</body>

</html> --}}
