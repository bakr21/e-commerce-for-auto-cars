<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <title>@yield('TitlePage') - Online Shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Language" content="{{ app()->getLocale() }}">
    <meta name="language" content="{{ app()->getLocale() }}">

    <!-- Favicon -->
    <link href="{{asset('website/assets/img/logoIcon.svg')}}" rel="icon">

    <!-- Google Web Fonts -->
    @if (app()->getLocale() == 'ar')
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
        {{-- <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet"> --}}
    @else
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    @endif

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    @if (app()->getLocale() == 'en')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    @else
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css">
    @endif

    <!-- Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icons/6.6.6/css/flag-icons.min.css">
    <link href="{{asset('website/assets/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('website/assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('website/assets/lib/owlcarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{asset('website/assets/css/ion.rangeSlider.min.css')}}" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Main CSS -->
    @if (app()->getLocale() == 'en')
        <link href="{{asset('website/assets/css/style.css')}}" rel="stylesheet">
    @else
        <link href="{{asset('website/assets/css/style-rtl.css')}}" rel="stylesheet">
    @endif

    <!-- Animations CSS -->
    <link href="{{asset('website/assets/css/animations.css')}}" rel="stylesheet">

</head>
<body>
    <!-- Topbar Start -->
    @include('website.layouts.inc.topbar')
    <!-- Topbar End -->

    <!-- Navbar Start -->
    @include('website.layouts.inc.navbar')
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    @include('website.layouts.inc.footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('website/assets/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('website/assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Javascript -->
    <script src="{{asset('website/assets/js/main.js')}}"></script>
    <script src="{{asset('website/assets/js/ion.rangeSlider.min.js')}}"></script>
    <script src="https://kit.fontawesome.com/3f5c27b3b0.js" crossorigin="anonymous"></script>
    <script>
        // Initialize AOS with custom settings
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });

        // Initialize tooltips
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        // Activate scroll animations
        $(window).scroll(function() {
            var windowHeight = $(window).height();
            var scrollTop = $(window).scrollTop();

            $('.scroll-animation').each(function() {
                var elementPos = $(this).offset().top;

                if (scrollTop + windowHeight > elementPos) {
                    $(this).addClass('active');
                }
            });
        });
    </script>

    @yield('customjs')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).on('click', '.add-to-cart', function() {
            var product_id = $(this).data('product-id');
            var qty = 1;

            $.ajax({
                method: 'POST',
                url: "{{ route('product.addToCart') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id,
                    quantity: qty
                },
                success: function(response) {
                    Swal.fire({
                        icon: response.icon,
                        text: response.msg,
                        timer: 1500,
                        timerProgressBar: true,
                    });
                    updateCartCount();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });

        function addToWishlist(id) {
            $.ajax({
                url: '{{ route('website.addToWishlist') }}',
                type: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        updateWishlistCount();
                        Swal.fire({
                            icon: 'success',
                            title: 'Added to Wishlist',
                            text: response.message,
                            timer: 1500,
                            timerProgressBar: true,
                        });
                    } else if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'Notice',
                            text: response.message,
                            timer: 1500,
                            timerProgressBar: true,
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        window.location.href = '{{ route('login') }}';
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    }
                }
            });
        }

        function updateCartCount() {
            $.ajax({
                url: "{{ route('cart.count') }}",
                type: 'GET',
                success: function(response) {
                    $('#cart-count').text(response.cart_count);
                },
                error: function(xhr) {
                    console.error('Error updating cart count: ' + xhr.responseText);
                }
            });
        }

        function updateWishlistCount() {
            $.ajax({
                url: '{{ route('wishlist.count') }}',
                type: 'GET',
                success: function(response) {
                    $('#wishlist-count').text(response.count);
                }
            });
        }

        // ✅ تحديث عدد العناصر في العربة والـ Wishlist عند تحميل الصفحة
        $(document).ready(function() {
            updateCartCount();
            updateWishlistCount();
        });
    </script>


</body>

</html>
