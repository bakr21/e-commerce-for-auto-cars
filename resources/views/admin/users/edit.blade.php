@extends('admin.layouts.master')
@section('TitlePage', 'edit user')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>User Management</h4>
            <h6>Edit/Update User</h6>
        </div>
    </div>

    <div class="card">
        <form action="" method="post" id="userForm" name="userForm">

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="form-control">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" id="email" value="{{ $user->email }}" class="form-control">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Role</label>
                            <select class="select" name="status" id="status" class="form-control">
                                <option {{ ($user->status == '' ) ? 'selected' : '' }} value="">Select</option>
                                <option {{ ($user->status == 1 ) ? 'selected' : '' }} value="1">Active</option>
                                <option {{ ($user->status == 0 ) ? 'selected' : '' }} value="0">Block</option>
                            </select>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" id="password" class="form-control">
                            <span>To change password you have to enter a value, otherwise live blanck .</span>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label> User Image</label>
                            <div class="image-upload">
                                <input type="file">
                                <div class="image-uploads">
                                    <img src="{{ asset('admin/assets/img/icons/upload.svg')}}" alt="img">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="product-list">
                            <ul class="row">
                                <li class="ps-0">
                                    <div class="productviewset">
                                        <div class="productviewsimg">
                                            <img src="{{ asset('admin/assets/img/customer/profile2.jpg')}}" alt="img">
                                        </div>
                                        <div class="productviewscontent">
                                            <a href="javascript:void(0);" class="hideset"><i
                                                    class="fa fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2">Update</button>
                        <a href="{{ route('users.index')}}" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </div>

        </form>
    </div>

</div>

<script>
    $(document).ready(function() {
        $("#userForm").submit(function(event) {
            event.preventDefault();
            $('button[type="submit"]').prop('disabled', true);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('users.update',$user->id) }}',
                type: 'Put',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    $('button[type="submit"]').prop('disabled', false);

                    if (response.status) {
                        window.location.href = "{{ route('users.index') }}";
                    } else {
                        handleErrors(response.errors);
                    }
                },
                error: function(xhr, status, error) {
                    $('button[type="submit"]').prop('disabled', false);
                    alert("حدث خطأ غير متوقع. يرجى المحاولة مرة أخرى.");  
                }
            });
        });

        function handleErrors(errors) {
            var fields = ['name', 'phone', 'email', 'status','password']; 

            fields.forEach(function(field) {
                var input = $("#" + field);
                var errorFeedback = input.siblings('p');
                if (errors[field]) {
                    input.addClass('is-invalid');
                    errorFeedback
                    .addClass('invalid-feedback')
                    .html(errors[field][0]);
                } else {
                    input.removeClass('is-invalid');
                    errorFeedback
                    .removeClass('invalid-feedback')
                    .html('');
                }
            });
        }
    });
</script>
@endsection