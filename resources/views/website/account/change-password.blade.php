@extends('website.layouts.master')
@section('TitlePage' , 'Change password')
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('home')}}">Home</a>
                <span class="breadcrumb-item active">change password</span>
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
                    <h2 class="h5 mb-0 pt-2 pb-2"><i class="fa-solid fa-lock"></i> Change Password</h2>
                </div>
            <form action="{{ route('website.account.processChange-password') }}" method="POST" name="changePasswordForm" id="changePasswordForm">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="mb-3">               
                            <label for="name">Old Password</label>
                            <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control">
                        </div>
                        <div class="mb-3">               
                            <label for="name">New Password</label>
                            <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control">
                        </div>
                        <div class="mb-3">               
                            <label for="name">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Old Password" class="form-control">
                        </div>
                        <div class="d-flex">
                            <button type="submit" id="submit" name="submit" class="btn btn-dark">Save</button>
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
        $('#changePasswordForm').submit(function(event){
            event.preventDefault();

            $('#submit').prop('disabled', true);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('website.account.processChange-password') }}",
                method: 'POST',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $('#submit').prop('disabled', false);
                    if(response.status) {
                        Swal.fire({
                        icon: 'success',
                        title: 'Password Updated',
                        text: response.message,
                        timer: 5000,
                        timerProgressBar: true,
                        }).then(() => {
                            location.reload(); 
                        });
                    } if (response.errors.old_password) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.errors.old_password[0],
                                timer: 5000,
                                timerProgressBar: true,
                            });
                        } else {
                            handleErrors(response.errors);
                        }
                }
            });
        });

        function handleErrors(errors) {
            var fields = ['old_password','new_password','confirm_password',];

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
