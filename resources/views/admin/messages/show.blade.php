@extends('admin.layouts.master')
@section('TitlePage', 'Messages')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Message List</h4>
            <h6>Manage your Message</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <h4>Message Num : #{{$message->id}}</h4>
                <div class="search-set">
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{asset('admin/assets/img/icons/search-white.svg')}}"
                                alt="img"></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                    src="{{asset('admin/assets/img/icons/pdf.svg')}}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                    src="{{asset('admin/assets/img/icons/excel.svg')}}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                    src="{{asset('admin/assets/img/icons/printer.svg')}}" alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>
            <h5 class="card-title">Personal Information</h5>
                        
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 col-12">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$message->name}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" value="{{$message->email}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-12">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{$message->phone}}" readonly>
                                </div>
                            </div>
            <h5 class="card-title">Message About</h5>
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input type="text" name="subject" class="form-control" value="{{$message->subject}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <input type="text" name="message" class="form-control" value="{{$message->message}}" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <a href="javascript:void(0);" class="btn btn-danger" onclick="deleteRecord({{$message->id}})">Delete Message</a>
                            </div>
                            <div class="col-lg-6">
                                <a href="{{route('message.index')}}" class="btn btn-primary">Back to Message list</a>
                            </div>
                        </div>
        </div>
    </div>

</div>

<script>

    function deleteRecord(id) {
        if(confirm("Are you sure you want to delete this record?")) {
            var url = '{{ route('message.destroy', 'id') }}';
            var newUrl = url.replace("id", id);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: newUrl,
                type: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    if(response.status === true) {
                        window.location.href = "{{ route('message.index') }}";
                    }
                },
                error: function(xhr, status, error) {
                    alert("An error occurred while deleting the record. Please try again.");
                }
            });
        }
    }

</script>
@endsection