@extends('admin.layouts.master')
@section('TitlePage', 'Profile')
@section('content')

<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Profile</h4>
            <h6>User Profile</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="profile-set">
                <div class="profile-top d-flex align-items-center">
                    <div class="profile-content">
                        <div class="profile-contentimg">
                            <img src="{{ asset('admin/assets/img/customer/customer5.jpg') }}" alt="Profile Image" id="blah">
                            <div class="profileupload">
                                <input type="file" id="imgInp" accept="image/*">
                                <a href="javascript:void(0);">
                                    <img src="{{ asset('admin/assets/img/icons/edit-set.svg') }}" alt="Edit">
                                </a>
                            </div>
                        </div>
                        <div class="profile-contentname">
                            <h2>William Castillo</h2>
                            <h4>Update your photo and personal details.</h4>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <button class="btn btn-submit me-2">Save</button>
                        <button class="btn btn-cancel">Cancel</button>
                    </div>
                </div>
            </div>

            <div class="profile-bottom">
                <form action="{{ route('admin.processChange-profile') }}" method="POST" id="changeProfileForm" name="changeProfileForm">
                    @csrf
                    <div class="row">
                        <h5 class="pb-3">Personal Details</h5>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="name" value="{{$user->name}}" placeholder="William" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" id="email" value="{{$user->email}}" placeholder="Castillo" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="tel" name="phone" id="phone" value="{{$user->phone}}" placeholder="+1452 876 5432" class="form-control">
                            </div>
                        </div>

                        
                    </div>

                    <div class="row">
                        <h5 class="pb-3">Change Password</h5>
                        <P class="fw-semibold"><a href="#" class="link-primary text-decoration-underline">Do you want to change your account password ?</a></P>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Old Password</label>
                                <div class="pass-group">
                                    <input type="password" name="old_password" id="old_password" placeholder="Old password" class="form-control">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                    <p></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>New Password</label>
                                <div class="pass-group">
                                    <input type="password" name="new_password" id="new_password" placeholder="New password" class="form-control">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                    <p></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="pass-group">
                                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" class="form-control">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                    <p></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" id="submit" class="btn btn-submit me-2">Update</button>
                            <button type="reset" class="btn btn-cancel">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // تحديث الصورة مباشرة بعد اختيارها
    $('#imgInp').change(function() {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#blah').attr('src', e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });

    $('#changeProfileForm').submit(function(event) {
        event.preventDefault();
        $('button[type="submit"]').prop('disabled', true);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.processChange-profile') }}",
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                $('button[type="submit"]').prop('disabled', false);
                if (response.status) {
                    window.location.href = "{{ route('admin.profile') }}";
                } else {
                    handleErrors(response.errors);
                }
            },
            error: function() {
                $('#submit').prop('disabled', false);
                alert("حدث خطأ غير متوقع. يرجى المحاولة مرة أخرى.");
            }
        });
    });

    function handleErrors(errors) {
        ['old_password', 'new_password', 'confirm_password'].forEach(field => {
            let input = $('#' + field);
            if (errors[field]) {
                input.addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors[field][0]);
            } else {
                input.removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
            }
        });
    }
</script>

@endsection
