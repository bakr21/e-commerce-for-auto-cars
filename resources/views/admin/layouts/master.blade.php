<!DOCTYPE html>
<html lang="en">
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<meta name="description" content="POS - Bootstrap Admin Template">
		<meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
		<meta name="author" content="Dreamguys - Bootstrap Admin Template">
		<meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('TitlePage')</title>
        <script src="{{asset('admin/assets/js/jquery-3.6.0.min.js')}}"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

        <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin/assets/img/ZAKY_BAKR.png')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap-datetimepicker.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/plugins/owlcarousel/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/plugins/fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">

</head>

<body>
    {{-- <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div> --}}

    <div class="main-wrapper">

		@include('admin.layouts.inc.navbar')

		@include('admin.layouts.inc.sidebar')

        <div class="page-wrapper">
			@yield('content')
        </div>
    </div>


    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>

    <script src="{{asset('admin/assets/js/jquery-3.6.0.min.js')}}"></script>

    <script src="{{asset('admin/assets/js/feather.min.js')}}"></script>

    <script src="{{asset('admin/assets/js/jquery.slimscroll.min.js')}}"></script>

    <script src="{{asset('admin/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{asset('admin/assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('admin/assets/plugins/apexchart/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/apexchart/chart-data.js')}}"></script>

    <script src="{{asset('admin/assets/plugins/owlcarousel/owl.carousel.min.js')}}"></script>


	<script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
	<script src="{{asset('admin/assets/plugins/select2/js/custom-select.js')}}"></script>

    <script src="{{asset('admin/assets/js/moment.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{asset('admin/assets/plugins/summernote/summernote-bs4.min.js')}}"></script>

    
    <script src="{{asset('admin/assets/plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/sweetalert/sweetalerts.min.js')}}"></script>
    
    <script src="{{asset('admin/assets/js/script.js')}}"></script>
	<script src="https://kit.fontawesome.com/3f5c27b3b0.js" crossorigin="anonymous"></script>

</body>

</html>