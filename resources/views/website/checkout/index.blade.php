@extends('website.layouts.master')
@section('TitlePage' , 'Checkout')
@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Checkout Start -->
<div class="container-fluid">
    <form id="orderForm" name="orderForm" action="{{ route('checkout.processCheckout')}}" method="post" >
        @csrf
        
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing
                        Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Name Full</label>
                            <input class="form-control" name="name" id="name" type="text" 
                                placeholder="John" value="{{ (!empty($customerAddress)) ? $customerAddress->name : '' }}">
                            <p></p>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" name="email" id="email" type="text" 
                                placeholder="example@email.com" value="{{ (!empty($customerAddress)) ? $customerAddress->email : '' }}">
                                <p></p>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" name="phone" id="phone" type="text" 
                                placeholder="+20 123 4567 8910" value="{{ (!empty($customerAddress)) ? $customerAddress->mobile : '' }}">
                            <p></p>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" name="address" id="address" type="text" 
                                placeholder="123 Street" value="{{ (!empty($customerAddress)) ? $customerAddress->address : '' }}">
                                <p></p>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" name="address2" id="address2" type="text" 
                                placeholder="123 Street" value="{{ (!empty($customerAddress)) ? $customerAddress->address2 : '' }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
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
                            <label>City</label>
                            <input class="form-control" name="city" id="city" type="text" 
                                placeholder="New York" value="{{ (!empty($customerAddress)) ? $customerAddress->city : '' }}">
                            <p></p>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" name="state" id="state" type="text" 
                                placeholder="New York" value="{{ (!empty($customerAddress)) ? $customerAddress->state : '' }}">
                            <p></p>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" name="zip" id="zip" type="text" 
                                placeholder="123" value="{{ (!empty($customerAddress)) ? $customerAddress->zip : '' }}">
                            <p></p>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Notes Order</label>
                            <input class="form-control" name="notes" id="notes" type="text" placeholder="Notes order">
                        </div>
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="shipto">
                                <label class="custom-control-label" for="shipto" data-toggle="collapse"
                                    data-target="#shipping-address">Ship to different address</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse mb-5" id="shipping-address">
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
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order
                        Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        @forelse ($carts as $cart)

                        <div class="d-flex justify-content-between">
                            <p>{{$cart->Product->name}} × {{$cart->qty}}</p>
                            <p>{{$cart->product->selling_price }}</p>
                        </div>
                        @empty
                        <p>No Product Yet !</p>
                        @endforelse
                    </div>
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>{{$subTotal}} EGP</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium" id="shippingAmount">{{ number_format($totalShippingCharge,2) }} EGP</h6>

                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="grandTotal">{{$grandTotal}} EGP</h5>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span
                            class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment_method" value="cod" id="payment_method_one" checked>
                                <label class="custom-control-label" for="payment_method_one">Pay cash on delivery </label>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment_method" value="card" id="payment_method_two" >
                                <label class="custom-control-label" for="payment_method_two" data-bs-toggle="collapse"
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
                        </div>

                        <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Checkout End -->

<script>
    $("#orderForm").submit(function(event){
        event.preventDefault();

        $('button[type="submit"]').prop('disabled', true);
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('checkout.processCheckout') }}',
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response){
                $('button[type="submit"]').prop('disabled', false);
                
                if (response.status == false){
                    var errors = response.errors;
                    handleErrors(errors);
                } else {
                    // عملية الحفظ ناجحة، إعادة التوجيه إلى صفحة الشكر
                    window.location.href = "{{ url('/thankyou') }}/" + response.orderId;
                }
            }
        });
    });

    $('#country').change(function(){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{ route('checkout.getOrderSummary') }}',
        type: 'POST',
        data: { country_id: $(this).val() },
        dataType: 'json',
        success: function(response) {
            if (response.status === true) {
                $("#shippingAmount").html(response.shippingCharge + ' EGP');
                $("#grandTotal").html(response.grandTotal + ' EGP');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error: ' + error);
        }
    });
});


    function handleErrors(errors) {
        var fields = ['name', 'email', 'phone', 'address', 'country', 'city', 'state', 'zip'];
        
        fields.forEach(function(field) {
            if (errors[field]) {
                $("#" + field).addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(errors[field]);
            } else {
                $("#" + field).removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('');
            }
        });
    }
</script>

    {{-- for payment method --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var paymentRadios = document.getElementsByName('payment_method');
        var usingCardCollapse = new bootstrap.Collapse(document.getElementById('usingcard'), {
            toggle: false
        });

        // Function to toggle collapse based on the selected radio button
        function toggleCollapse() {
            if (document.getElementById('payment_method_two').checked) {
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
    });

</script>

@endsection
