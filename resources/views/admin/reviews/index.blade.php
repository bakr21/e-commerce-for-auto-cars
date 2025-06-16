@extends('admin.layouts.master')
@section('TitlePage', 'Profile')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Reviews List</h4>
            <h6>Manage your Reviews</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{asset('admin/assets/img/icons/search-white.svg')}}" alt="img"></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="{{asset('admin/assets/img/icons/pdf.svg')}}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{asset('admin/assets/img/icons/excel.svg')}}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{asset('admin/assets/img/icons/printer.svg')}}" alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Created From</th>
                            <th>Username</th>
                            <th>Name Product</th>
                            <th>Email</th>
                            <th>Comment</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reviews as $review)
                        <tr>
                            <td>{{$review->id}}</td>
                            <td>{{ $review->created_at->diffForHumans() }}</td>
                            <td>{{ $review->username }}</td>
                            <td>{{ $review->product->name }}</td>
                            <td>{{ $review->email }}</td>
                            <td>{{ $review->comment }}</td>
                            <td>{{ $review->rating }}</td>
                            <td>
                                @if($review->status == 1)
                                    <span class="badge bg-success">show</span>
                                @else
                                    <span class="badge bg-danger">don't show</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('reviews.updateStatus', $review->id) }}" method="POST">
                                    @csrf
                                    <select name="status" class="form-select" onchange="this.form.submit()">
                                        <option value="1" {{ $review->status == 1 ? 'selected' : '' }}>show</option>
                                        <option value="0" {{ $review->status == 0 ? 'selected' : '' }}>don't show</option>
                                    </select>
                                </form>
                            </td>
                            <td>{{ $review->created_at }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No reviews found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
