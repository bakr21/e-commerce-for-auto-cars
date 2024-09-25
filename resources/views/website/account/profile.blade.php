@extends('website.layouts.master')
@section('TitlePage' , 'Profile')
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('home')}}">Home</a>
                <span class="breadcrumb-item active">Profile</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-3 col-md-3">
            @include('website.account.account-panel')
        </div>
        <div class="col-md-9">
            <div class="card rounded-0">
                <div class="card-header">
                    <h2 class="h5 mb-0 pt-2 pb-2"><i class="fa-solid fa-user-gear"></i> Personal Information</h2>
                </div>
                <form action="" name="profileForm" id="profileForm">

                    <div class="card-body p-4">
                        <div class="row">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input value="{{ $user->name}}" type="text" name="name" id="name" placeholder="Enter Your Name" class="form-control">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input value="{{ $user->email}}" type="text" name="email" id="email" placeholder="Enter Your Email"
                                    class="form-control">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="phone">Phone</label>
                                <input value="{{ $user->phone }}" type="text" name="phone" id="phone" placeholder="Enter Your Phone"
                                    class="form-control">
                                <p></p>
                            </div>
    
                            <div class="mb-3">
                                <label for="phone">Address</label>
                                <textarea name="address" id="address" class="form-control" cols="30" rows="5"
                                    placeholder="Enter Your Address">{{ $user->addres }}</textarea>
                                <p></p>
                            </div>

                            <div class="mb-3">
                                <label >Region</label>
                                <select class="form-control" name="region" id="region">
                                    <option value="" {{ is_null($user->region) ? 'selected' : '' }}>Select Region - Egypt</option>
                                    <option value="alex" {{ $user->region == 'alex' ? 'selected' : '' }}>Alexandria - Egypt</option>
                                    <option value="damn" {{ $user->region == 'damn' ? 'selected' : '' }}>Dam - Egypt</option>
                                    <option value="dand" {{ $user->region == 'dand' ? 'selected' : '' }}>Dandara - Egypt</option>
                                </select>
                                <p></p>
                            </div>

                            <div class="d-flex">
                                <button type="submit" class="btn btn-dark">Update</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="card rounded-0 mt-4">
                <div class="card-header">
                    <h2 class="h5 mb-0 pt-2 pb-2"><i class="fa-solid fa-map-location-dot"></i> Billing Address</h2>
                </div>
                <form action="" name="addressForm" id="addressForm">

                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Name Full</label>
                                <input class="form-control" name="billing_name" id="billing_name" type="text" 
                                    placeholder="John" value="{{ (!empty($customerAddress)) ? $customerAddress->name : '' }}">
                                <p></p>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" name="billing_email" id="billing_email" type="text" 
                                    placeholder="example@email.com" value="{{ (!empty($customerAddress)) ? $customerAddress->email : '' }}">
                                    <p></p>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input class="form-control" name="billing_phone" id="billing_phone" type="text" 
                                    placeholder="+20 123 4567 8910" value="{{ (!empty($customerAddress)) ? $customerAddress->mobile : '' }}">
                                <p></p>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Address Line 1</label>
                                <input class="form-control" name="billing_address" id="billing_address" type="text" 
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
                                <select class="custom-select" name="country_id" id="country_id">
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

                            <div class="d-flex">
                                <button type="submit" class="btn btn-dark">Update</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('customjs')
    <script>
        $('#profileForm').submit(function(event){
            event.preventDefault();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('website.account.updateprofile') }}",
                method: 'POST',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if(response.status) {
                        Swal.fire({
                        icon: 'success',
                        title: 'Profile Updated',
                        text: response.message,
                        timer: 5000,
                        timerProgressBar: true,
                    }).then(() => {
                        location.reload(); 
                    });
                    } else {
                        handleErrors(response.errors);
                    }
                }
            });
        });

        $('#addressForm').submit(function(event){
            event.preventDefault();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('website.account.updateAddress') }}",
                method: 'POST',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if(response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Profile Updated',
                            text: response.message,
                            timer: 5000,
                            timerProgressBar: true,
                        }).then(() => {
                            location.reload(); 
                        });

                    } else {
                        handleErrors(response.errors);
                    }
                }
            });
        });

        function handleErrors(errors) {
            var fields = ['name','email','phone','address','region','billing_name','billing_email','billing_phone', 'billing_address' ,'country_id', 'city', 'state', 'zip'];

            fields.forEach(function(field) {
                if (errors[field]) {
                    $("#" + field).addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors[field][0]);
                } else {
                    $("#" + field).removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                }
            });
        }

    </script>
@endsection
