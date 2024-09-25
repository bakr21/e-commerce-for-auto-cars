@extends('admin.layouts.master')
@section('TitlePage', 'Pages')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Pages List</h4>
            <h6>Manage your page</h6>
        </div>
        <div class="page-btn">
            <a href="{{route('pages.create')}}" class="btn btn-added"><img src="{{asset('admin/assets/img/icons/plus.svg')}}" alt="img"
                    class="me-2">Add page</a>
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
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Show</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pages as $page)
                        <tr>
                            <td>{{ $page->id}}</td>
                            <td>{{ $page->name}}</td>
                            <td>{{ $page->slug}}</td>
                            <td><a href="{{ route('website.page', $page->slug) }}" target="_blank">view page</a></td>
                            <td>
                                <a class="me-3" href="{{ route('pages.edit',$page->id) }}">
                                    <img src="{{asset('admin/assets/img/icons/edit.svg')}}" alt="img">
                                </a>
                                <a class="me-3" href="javascript:void(0);" onclick="deleteRecord({{$page->id}})">
                                    <img src="{{asset('admin/assets/img/icons/delete.svg')}}" alt="img">
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No Pages Yet!</td>
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
            var url = '{{ route('pages.destroy', 'id') }}';
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
                        window.location.href = "{{ route('pages.index') }}";
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