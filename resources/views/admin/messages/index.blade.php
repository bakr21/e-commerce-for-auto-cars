@extends('admin.layouts.master')
@section('TitlePage', 'Messages')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Message List</h4>
            <h6>Manage your Message</h6>
        </div>
        <div class="page-btn">
            <a href="{{route('message.index')}}" class="btn btn-added"><img src="{{asset('admin/assets/img/icons/plus.svg')}}" class="me-2"
                    alt="img">List Message</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
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

            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                        <tr id="message-{{ $message->id }}">
                            <td>{{ $message->id }}</td>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->subject }}</td>
                            <td>
                                <a class="me-3" href="{{route('message.show',$message->id)}}">
                                    <img src="{{asset('admin/assets/img/icons/eye.svg')}}" alt="img">
                                </a>
                                <a class="me-3" href="javascript:void(0);" onclick="deleteRecord({{$message->id}})">
                                    <img src="{{asset('admin/assets/img/icons/delete.svg')}}" alt="img">
                                </a>
                            </td>
                        </tr>
                        
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No Messages Yet!</td>
                        </tr>
                        @endforelse
                        
                    </tbody>
                </table>
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