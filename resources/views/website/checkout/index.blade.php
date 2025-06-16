@extends('website.layouts.master')
@section('TitlePage' , 'Checkout')
@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">{{__('breadcrumb.home')}}</a>
                <a class="breadcrumb-item text-dark" href="#">{{__('breadcrumb.shop')}}</a>
                <span class="breadcrumb-item active">{{__('breadcrumb.checkout')}}</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

@php
    // Get coupon data from session
    $coupon = session('coupon');
    $discount = session('coupon.discount', 0);

    // Calculate discount if not already calculated
    if ($discount == 0 && isset($coupon['discount_type'], $coupon['discount_amount'])) {
        if ($coupon['discount_type'] === 'percentage') {
            $discount = $subTotal * ($coupon['discount_amount'] / 100);
        } else {
            $discount = min($coupon['discount_amount'], $subTotal);
        }
        $discount = round($discount, 2);
    }

    // Calculate grand total after discount
    $grandTotal = ($subTotal + $totalShippingCharge) - $discount;
@endphp

<!-- Checkout Start -->
<div class="container-fluid">
    <form id="orderForm" name="orderForm" action="{{ route('checkout.processCheckout')}}" method="post">
        @csrf

        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">
                    {{__('checkout.billing_address')}}</span></h5>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>{{__('checkout.name_full')}}</label>
                            <input class="form-control" name="name" id="name" type="text"
                                placeholder="John" value="{{ (!empty($customerAddress)) ? $customerAddress->name : '' }}">
                            <p></p>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{__('checkout.email')}}</label>
                            <input class="form-control" name="email" id="email" type="text"
                                placeholder="example@email.com" value="{{ (!empty($customerAddress)) ? $customerAddress->email : '' }}">
                                <p></p>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{__('checkout.phone')}}</label>
                            <input class="form-control" name="phone" id="phone" type="text"
                                placeholder="+20 123 4567 8910" value="{{ (!empty($customerAddress)) ? $customerAddress->mobile : '' }}">
                            <p></p>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>{{__('checkout.address_1')}}</label>
                            <input class="form-control" name="address" id="address" type="text"
                                placeholder="123 Street" value="{{ (!empty($customerAddress)) ? $customerAddress->address : '' }}">
                                <p></p>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>{{__('checkout.address_2')}} ({{__('checkout.optional')}})</label>
                            <input class="form-control" name="address2" id="address2" type="text"
                                placeholder="123 Street" value="{{ (!empty($customerAddress)) ? $customerAddress->address2 : '' }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{__('checkout.country')}}</label>
                            <select class="custom-select" name="country" id="country">
                                @if ($countries->isNotEmpty())
                                <option value="">please choose country</option>
                                @foreach ($countries as $country)
                                <option {{ (!empty($customerAddress) && $customerAddress->country_id == $country->id) ? 'selected' : '' }} value="{{ $country->id }}" {{ $country->code == 'EG' ? 'selected' : '' }}>
                                    {{$country->name}}</option>
                                @endforeach
                                @endif
                            </select>
                            <p></p>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{__('checkout.city')}}</label>
                            <input class="form-control" name="city" id="city" type="text"
                                placeholder="New York" value="{{ (!empty($customerAddress)) ? $customerAddress->city : '' }}">
                            <p></p>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{__('checkout.state')}}</label>
                            <input class="form-control" name="state" id="state" type="text"
                                placeholder="New York" value="{{ (!empty($customerAddress)) ? $customerAddress->state : '' }}">
                            <p></p>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{__('checkout.zip')}}</label>
                            <input class="form-control" name="zip" id="zip" type="text"
                                placeholder="123" value="{{ (!empty($customerAddress)) ? $customerAddress->zip : '' }}">
                            <p></p>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>{{__('checkout.note_order')}}</label>
                            <input class="form-control" name="notes" id="notes" type="text" placeholder="Notes order">
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="shipto">
                                <label class="custom-control-label" for="shipto" data-toggle="collapse"
                                    data-target="#shipping-address">Ship to different address</label>
                            </div>
                        </div> --}}
                    </div>
                </div>
                {{-- <div class="collapse mb-5" id="shipping-address">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Shipping
                            Address</span></h5>
                    <div class="bg-light p-30">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>First Name</label>
                                <input class="form-control" type="text" placeholder="John">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" placeholder="Doe">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" placeholder="example@email.com">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input class="form-control" type="text" placeholder="+123 456 789">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address Line 1</label>
                                <input class="form-control" type="text" placeholder="123 Street">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address Line 2</label>
                                <input class="form-control" type="text" placeholder="123 Street">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Country</label>
                                <select class="custom-select">
                                    <option selected>United States</option>
                                    <option>Afghanistan</option>
                                    <option>Albania</option>
                                    <option>Algeria</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>State</label>
                                <input class="form-control" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ZIP Code</label>
                                <input class="form-control" type="text" placeholder="123">
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">{{__('checkout.order_total')}}</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>{{__('checkout.subtotal')}}</h6>
                            <h6>{{ number_format($subTotal, 2) }} {{__('product.egp')}}</h6>
                        </div>

                        @if(session('coupon') && $discount > 0)
                        <div class="d-flex justify-content-between mb-3 discount-row">
                            <h6 class="font-weight-medium">
                                {{__('checkout.discount')}} (<span id="discountCode">{{ session('coupon')['code'] }}</span>)
                                <button type="button" id="removeCoupon" class="btn btn-sm btn-link text-danger p-0 ml-2">
                                    <small>{{__('checkout.remove')}}</small>
                                </button>
                            </h6>
                            <h6 class="font-weight-medium text-danger" id="discountAmount">
                                -{{ number_format($discount, 2) }} {{ __('product.egp') }}
                            </h6>
                        </div>
                        @endif

                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">{{__('checkout.shipping')}}</h6>
                            <h6 class="font-weight-medium" id="shippingAmount">{{ number_format($totalShippingCharge, 2) }} {{__('product.egp')}}</h6>
                        </div>
                    </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>{{__('checkout.grand_total')}}</h5>
                                <h5 id="grandTotal">{{$grandTotal}} {{__('product.egp')}}</h5>
                            </div>
                        </div>
                </div>
                @if(!session('coupon'))
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">{{__('checkout.coupon_code')}}</span>
                </h5>
                <div class="mb-5">

                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4"
                               name="coupon_code" id="coupon_code"
                               placeholder="{{__('checkout.coupon_placeholder')}}">
                        <div class="input-group-append">
                            <button type="button" id="applyCoupon" class="btn btn-primary">
                                {{__('checkout.apply_coupon')}}
                            </button>
                        </div>
                    </div>
                    <div id="couponMessage" class="mt-2 small"></div>
                </div>
                    @endif

                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span
                            class="bg-secondary pr-3">{{__('checkout.payment_method')}}</span></h5>
                    <div class="bg-light p-30">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment_method" value="cod" id="payment_method_one" checked>
                                <label class="custom-control-label" for="payment_method_one">{{__('checkout.payment_method_cod')}} </label>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment_method" value="stripe" id="payment_method_third" >
                                <label class="custom-control-label" for="payment_method_third">{{__('checkout.payment_method_stripe')}} ({{__('checkout.test_mode')}})</label>
                            </div>
                            <span class="fs-6 text-light bg-danger pb-3">{{__('checkout.test_mode_message')}}</span>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment_method" value="card" id="payment_method_two">
                                <label class="custom-control-label" for="payment_method_two">{{__('checkout.payment_method_paypal')}} ({{__('checkout.test_mode')}})</label>
                            </div>
                            <small class="text-info d-block mt-1">* المبلغ سيتم تحويله إلى الدولار الأمريكي (USD) عند الدفع بواسطة PayPal</small>
                        </div>
                        {{-- <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment_method" value="cardpaypaltest" id="payment_method_four" >
                                <label class="custom-control-label" for="payment_method_four" data-bs-toggle="collapse"
                                    data-bs-target="#usingcard">Pay using card</label>
                            </div>
                        </div>
                        <div class="collapse" id="usingcard">
                            <div class="card-body p-0 mb-4">
                                <div class="mb-3">
                                    <label for="card_number" class="mb-2">Card Number</label>
                                    <input type="text" name="card_number" id="card_number" placeholder="Valid Card Number"
                                        class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="expiry_date" class="mb-2">Expiry Date</label>
                                        <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YYYY"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cvv_code" class="mb-2">CVV Code</label>
                                        <input type="text" name="cvv_code" id="cvv_code" placeholder="123"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3">
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            <span class="button-text">{{__('checkout.place_order')}}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Checkout End -->

<script>
    $(document).ready(function() {
        // تطبيق الكوبون
        $('#applyCoupon').click(function() {
            applyCouponHandler();
        });

        function applyCouponHandler() {
            let couponCode = $('#coupon_code').val();
            let countryId = $('#country').val();

            if (!couponCode) {
                showCouponMessage('{{__("checkout.enter_coupon_code")}}', 'danger');
                return;
            }

            if (!countryId) {
                showCouponMessage('{{__("checkout.select_country_first")}}', 'danger');
                return;
            }

            // Show loading indicator
            $('#applyCoupon').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> {{__("checkout.applying")}}');

            $.ajax({
                url: '{{ route("checkout.applyDiscount") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    coupon_code: couponCode,
                    country_id: countryId
                },
                success: function(response) {
                    if (response.status) {
                        updateOrderSummary(response);
                        showCouponMessage('{{__("checkout.coupon_applied_success")}}', 'success');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showCouponMessage(response.message || '{{__("checkout.coupon_invalid")}}', 'danger');
                        $('#applyCoupon').prop('disabled', false).text('{{__("checkout.apply_coupon")}}');
                    }
                },
                error: function(xhr) {
                    let errorMessage = '{{__("checkout.server_error")}}';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    showCouponMessage(errorMessage, 'danger');
                    $('#applyCoupon').prop('disabled', false).text('{{__("checkout.apply_coupon")}}');
                }
            });
        }

        // إزالة الكوبون
        $('#removeCoupon').click(removeCouponHandler);

        function removeCouponHandler() {
            // Show loading indicator on the remove button
            let $removeBtn = $('#removeCoupon');
            let originalText = $removeBtn.html();
            $removeBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $removeBtn.prop('disabled', true);

            $.ajax({
                url: '{{ route("checkout.removeDiscount") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status) {
                        updateOrderSummary(response);
                        showCouponMessage('{{__("checkout.coupon_removed")}}', 'success');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        $removeBtn.html(originalText);
                        $removeBtn.prop('disabled', false);
                        showCouponMessage('{{__("checkout.coupon_remove_error")}}', 'danger');
                    }
                },
                error: function() {
                    $removeBtn.html(originalText);
                    $removeBtn.prop('disabled', false);
                    showCouponMessage('{{__("checkout.server_error")}}', 'danger');
                }
            });
        }

        // تحديث الملخص عند تغيير الدولة
        $('#country').change(function() {
            let countryId = $(this).val();
            if (!countryId) return;

            $.ajax({
                url: '{{ route("checkout.getOrderSummary") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    country_id: countryId
                },
                success: function(response) {
                    if (response.status) {
                        updateOrderSummary(response);
                    }
                }
            });
        });

        // دالة تحديث الملخص
        function updateOrderSummary(response) {
            // Update shipping amount
            $('#shippingAmount').text(response.shippingCharge.toFixed(2) + ' {{__("product.egp")}}');

            // Update grand total
            $('#grandTotal').text(response.grandTotal.toFixed(2) + ' {{__("product.egp")}}');

            // Handle discount display
            if (response.discount > 0 && response.discountDetails) {
                // If there's a discount row already in the DOM
                if ($('.discount-row').length) {
                    $('.discount-row').removeClass('d-none');
                    $('#discountAmount').text('-' + response.discount.toFixed(2) + ' {{__("product.egp")}}');
                    $('#discountCode').text(response.discountDetails.code);
                } else {
                    // If we need to add the discount row dynamically
                    // This will be shown after page reload, but we update the DOM for consistency
                    let discountHtml = `
                        <div class="d-flex justify-content-between mb-3 discount-row">
                            <h6 class="font-weight-medium">
                                {{__('checkout.discount')}} (${response.discountDetails.code})
                                <button type="button" id="removeCoupon" class="btn btn-sm btn-link text-danger p-0 ml-2">
                                    <small>{{__('checkout.remove')}}</small>
                                </button>
                            </h6>
                            <h6 class="font-weight-medium text-danger">-${response.discount.toFixed(2)} {{__('product.egp')}}</h6>
                        </div>
                    `;
                    $('.border-bottom.pt-3.pb-2 .d-flex.justify-content-between:first').after(discountHtml);

                    // Add event listener to the newly created remove button
                    $('#removeCoupon').click(removeCouponHandler);
                }
            } else {
                $('.discount-row').addClass('d-none');
            }
        }

        // دالة عرض رسائل الكوبون
        function showCouponMessage(message, type) {
            let $msgDiv = $('#couponMessage');
            $msgDiv.removeClass('alert-success alert-danger')
                  .addClass('alert alert-' + type)
                  .text(message)
                  .show();

            setTimeout(() => $msgDiv.fadeOut(), 3000);
        }
    });
    </script>
    {{-- for payment method --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle form submission
        const orderForm = document.getElementById('orderForm');
        if (orderForm) {
            orderForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent normal form submission

                // Show loading spinner
                const submitBtn = this.querySelector('button[type="submit"]');
                const spinner = submitBtn.querySelector('.spinner-border');
                const buttonText = submitBtn.querySelector('.button-text');

                spinner.classList.remove('d-none');
                buttonText.textContent = '{{__("checkout.processing")}}';
                submitBtn.disabled = true;

                // Get form data
                const formData = new FormData(this);

                // Send AJAX request
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            // If payment method is COD, redirect to thank you page
                            if (response.payment_method === 'cod') {
                                // Get current locale from URL
                                const currentPath = window.location.pathname;
                                const locale = currentPath.split('/')[1]; // ar or en
                                window.location.href = '/' + locale + '/thankyou/' + response.orderId;
                            }
                            // If payment method requires redirect (PayPal, Stripe)
                            else if (response.redirect_url) {
                                // If PayPal, show amount in USD before redirecting
                                if (response.payment_method === 'card' && response.amount_usd) {
                                    if (confirm('سيتم تحويلك إلى PayPal للدفع بمبلغ $' + response.amount_usd + ' دولار أمريكي. هل تريد المتابعة؟')) {
                                        window.location.href = response.redirect_url;
                                    } else {
                                        // User cancelled
                                        submitBtn.disabled = false;
                                        spinner.classList.add('d-none');
                                        buttonText.textContent = '{{__("checkout.place_order")}}';
                                    }
                                } else {
                                    // For other payment methods like Stripe
                                    window.location.href = response.redirect_url;
                                }
                            }
                            else {
                                // Fallback
                                alert(response.message || 'Order placed successfully');
                                submitBtn.disabled = false;
                                spinner.classList.add('d-none');
                                buttonText.textContent = '{{__("checkout.place_order")}}';
                            }
                        } else {
                            // Show error message
                            alert(response.message || 'An error occurred. Please try again.');
                            submitBtn.disabled = false;
                            spinner.classList.add('d-none');
                            buttonText.textContent = '{{__("checkout.place_order")}}';
                        }
                    },
                    error: function(xhr) {
                        // Handle validation errors
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            // Display errors next to form fields
                            for (const field in errors) {
                                const errorMsg = errors[field][0];
                                const inputField = document.getElementById(field);
                                if (inputField) {
                                    const errorElement = inputField.nextElementSibling;
                                    if (errorElement && errorElement.tagName === 'P') {
                                        errorElement.textContent = errorMsg;
                                        errorElement.style.color = 'red';
                                    }
                                }
                            }
                        } else {
                            // General error
                            alert('An error occurred. Please try again later.');
                        }

                        submitBtn.disabled = false;
                        spinner.classList.add('d-none');
                        buttonText.textContent = '{{__("checkout.place_order")}}';
                    }
                });
            });
        }

        // Payment method collapse handling
        var paymentRadios = document.getElementsByName('payment_method');
        var usingCardCollapse = document.getElementById('usingcard');

        if (usingCardCollapse) {
            usingCardCollapse = new bootstrap.Collapse(usingCardCollapse, {
                toggle: false
            });

            // Function to toggle collapse based on the selected radio button
            function toggleCollapse() {
                if (document.getElementById('payment_method_four') && document.getElementById('payment_method_four').checked) {
                    usingCardCollapse.show();
                } else {
                    usingCardCollapse.hide();
                }
            }

            // Initial check on page load
            toggleCollapse();

            // Add event listeners to all payment radio buttons
            paymentRadios.forEach(function (radio) {
                radio.addEventListener('change', toggleCollapse);
            });
        }
    });

</script>

@endsection
