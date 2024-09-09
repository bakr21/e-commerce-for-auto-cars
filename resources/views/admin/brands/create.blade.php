@extends('admin.layouts.master')
@section('TitlePage', 'Create Brands')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Brand ADD</h4>
            <h6>Create new Brand</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data" id="createBrandForm" name="createBrandForm">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="name">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Slug</label>
                            <input readonly type="text" id="slug" name="slug" class="form-control" placeholder="slug">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="select form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    {{-- <div class="col-lg-12">
                        <div class="form-group">
                            <label>Brand Image</label>
                            <p></p>
                            <div class="image-upload">
                                <input type="file" name="image" class="form-control-file" id="imageInput">
                                <div class="image-uploads">
                                    <img src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2">Create</button>
                        <a href="{{ route('brands.index') }}" class="btn btn-cancel">Cancel & back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("#createBrandForm").submit(function(event) {
        event.preventDefault();
        $('button[type="submit"]').prop('disabled', true);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('brands.store') }}',
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                $('button[type="submit"]').prop('disabled', false);

                if (response.status === false) {
                    handleErrors(response.errors);
                } else {
                    // حفظ ناجح، إعادة التوجيه إلى صفحة الشكر
                    window.location.href = "{{ route('brands.create') }}";
                }
            },
            error: function(xhr, status, error) {
                $('button[type="submit"]').prop('disabled', false);
                // يمكن معالجة الأخطاء الأخرى هنا
                alert("حدث خطأ غير متوقع. يرجى المحاولة مرة أخرى.");
            }
        });
    });

    function handleErrors(errors) {
        // مصفوفة الحقول التي يمكن أن تحتوي على أخطاء
        var fields = ['name','slug','image'];
        
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
    // for slug generation 
    $("#name").change(function(){
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("getSlug") }}',
            type: 'get',
            data: { title: element.val() },
            dataType: 'json',
            success: function (response) {
                $("button[type=submit]").prop('disabled', false);
                if (response["status"] == true) {
                    $("#slug").val(response["slug"]);
                }
            }
        });
    });

</script>
@endsection
