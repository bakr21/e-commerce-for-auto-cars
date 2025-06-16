@extends('admin.layouts.master')
@section('TitlePage', 'Carousel Management')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Carousel List</h4>
            <h6>Manage your carousel slides</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('carousels.create') }}" class="btn btn-added">
                <i class="fa fa-plus"></i> Add Carousel Slide
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{ asset('admin/assets/img/icons/search-white.svg') }}" alt="img"></a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title (EN)</th>
                            <th>Title (AR)</th>
                            <th>Status</th>
                            <th>Sort Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carousels as $carousel)
                        <tr>
                            <td>{{ $carousel->id }}</td>
                            <td>
                                <img src="{{ Storage::url($carousel->image) }}" alt="Carousel Image" class="img-fluid" style="max-width: 100px; max-height: 60px;">
                            </td>
                            <td>{{ $carousel->title_en }}</td>
                            <td>{{ $carousel->title_ar }}</td>
                            <td>
                                @if($carousel->status)
                                <span class="badges bg-lightgreen">Active</span>
                                @else
                                <span class="badges bg-lightred">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $carousel->sort_order }}</td>
                            <td>
                                <a class="me-3" href="{{ route('carousels.edit', $carousel->id) }}">
                                    <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="Edit">
                                </a>
                                <a class="me-3" href="{{ route('carousels.show', $carousel->id) }}">
                                    <img src="{{ asset('admin/assets/img/icons/eye.svg') }}" alt="View">
                                </a>
                                <form action="{{ route('carousels.destroy', $carousel->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this carousel slide?')">
                                        <img src="{{ asset('admin/assets/img/icons/delete.svg') }}" alt="Delete">
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
