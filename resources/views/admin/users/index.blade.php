@extends('admin.layouts.master')
@section('TitlePage', 'users')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>User List</h4>
            <h6>Manage your User</h6>
        </div>
        <div class="page-btn">
            <a href="{{route('users.create')}}" class="btn btn-added"><img src="{{asset('admin/assets/img/icons/plus.svg')}}" alt="img"
                    class="me-2">Add User</a>
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
                <table class="table  datanew">
                    <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>#</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Region</th>
                            
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                                
                                
                            <td>
                                <label class="checkboxs">
                                    <input type="checkbox">
                                    <span class="checkmarks"></span>
                                </label>
                            </td>
                            <td>{{ $user->id}}</td>
                            <td class="productimgname">
                                <a href="javascript:void(0);" class="product-img">
                                    <img src="assets/img/customer/customer1.jpg" alt="product">
                                </a>
                            </td>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->phone}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->region}} </td>
                            <td>
                                <div class="status-toggle d-flex justify-content-between align-items-center">
                                    <input type="checkbox" id="user{{ $user->id }}" class="check" {{ $user->status ? 'checked' : '' }} disabled>
                                    <label for="user{{ $user->id }}" class="checktoggle">checkbox</label>
                                </div>
                            </td>
                            <td>
                                <a class="me-3" href="{{ route('users.edit',$user->id) }}">
                                    <img src="{{asset('admin/assets/img/icons/edit.svg')}}" alt="img">
                                </a>
                                <a class="me-3" href="javascript:void(0);" onclick="deleteRecord({{$user->id}})">
                                    <img src="{{asset('admin/assets/img/icons/delete.svg')}}" alt="img">
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No Users Yet!</td>
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
            var url = '{{ route('users.destroy', 'id') }}';
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
                        window.location.href = "{{ route('users.index') }}";
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