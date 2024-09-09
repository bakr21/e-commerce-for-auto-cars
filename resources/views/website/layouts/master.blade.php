<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('TitlePage') - Online Shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <!-- Favicon -->
    <link href="{{asset('website/assets/img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- Libraries Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{asset('website/assets/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('website/assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('website/assets/lib/owlcarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{asset('website/assets/css/ion.rangeSlider.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('website/assets/css/style.css')}}" rel="stylesheet">
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
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('website/assets/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('website/assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('website/assets/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('website/assets/mail/contact.js')}}"></script>
    <script src="{{asset('website/assets/js/ion.rangeSlider.min.js')}}"></script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Javascript -->
    <script src="{{asset('website/assets/js/main.js')}}"></script>
    <script src="https://kit.fontawesome.com/3f5c27b3b0.js" crossorigin="anonymous"></script>

    @yield('customjs')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        function addtocart() {
            var product_id = $('#product_id').val();
            var qty = $('#qty_value').val();
    
            console.log('Product ID: ' + product_id + ' | Quantity: ' + qty);
    
            $.ajax({
                method: 'POST',
                url: "{{ route('product.addToCart') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id,
                    quantity: qty
                },
                success: function(response) {
                    Swal.fire(response.msg);
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + error);
                    console.error(xhr.responseText);
                }
            });
        }

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
                        // إذا تمت العملية بنجاح
                        Swal.fire({
                            icon: 'success',
                            title: 'Added to Wishlist',
                            text: response.message,
                        });
                    } else if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'Notice',
                            text: response.message,
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
                url: "{{ route('cart.count') }}", // رابط الـ route للحصول على عدد المنتجات
                type: 'GET',
                success: function(response) {
                    // تحديث عدد المنتجات المعروض في الأيقونة
                    $('#cart-count').text(response.cart_count);
                },
                error: function(xhr, status, error) {
                    console.error('Error updating cart count: ' + error);
                }
            });
        }

        function updateWishlistCount() {
            $.ajax({
                url: '{{ route('wishlist.count') }}', // مسار يعيد عدد المنتجات في المفضلة
                type: 'GET',
                success: function(response) {
                    // تحديث العدد في الـ HTML
                    $('#wishlist-count').text(response.count);
                }
            });
        }
    </script>
    
</body>

</html>