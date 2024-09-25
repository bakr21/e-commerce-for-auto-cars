@extends('admin.layouts.master')
@section('TitlePage', 'Edit Page')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Pages Management</h4>
            <h6>Add/Update page</h6>
        </div>
    </div>

    <div class="card">
        <form action="" method="post" id="pageForm" name="pageForm">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" value="{{ $page->name}}" name="name" id="name" class="form-control" placeholder="name">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Slug</label>
                            <input readonly type="text" value="{{ $page->slug}}" name="slug" id="slug" class="form-control" placeholder="slug">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Content</label>
                            <textarea id="summernote" name="summernote">{!! $page->content !!}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label> User Image</label>
                            <div class="image-upload">
                                <input type="file" name="image" id="image">
                                <div class="image-uploads">
                                    <img src="{{asset('admin/assets/img/icons/upload.svg')}}" alt="img">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2">Update</button>
                        <a href="{{ route('pages.index')}}" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
<script>
    $(document).ready(function() {
        $("#pageForm").submit(function(event) {
            event.preventDefault();
            $('button[type="submit"]').prop('disabled', true);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('pages.update',$page->id) }}',
                type: 'PUT',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    $('button[type="submit"]').prop('disabled', false);

                    if (response.status) {
                        window.location.href = "{{ route('pages.index') }}";
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
                var fields = ['name', 'slug', 'summernote']; 

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