@extends('admin.layouts.master')
@section('TitlePage', 'Side Banners Management')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Side Banners List</h4>
            <h6>Manage your side banners</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('side-banners.create') }}" class="btn btn-added">
                <i class="fa fa-plus"></i> Add Side Banner
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
                            <th>Position</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sideBanners as $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td>
                                <img src="{{ Storage::url($banner->image) }}" alt="Banner Image" class="img-fluid" style="max-width: 100px; max-height: 60px;">
                            </td>
                            <td>{{ $banner->title_en }}</td>
                            <td>{{ $banner->title_ar }}</td>
                            <td>
                                @if($banner->position == 1)
                                <span class="badges bg-lightblue">Top</span>
                                @else
                                <span class="badges bg-lightyellow">Bottom</span>
                                @endif
                            </td>
                            <td>
                                @if($banner->status)
                                <span class="badges bg-lightgreen">Active</span>
                                @else
                                <span class="badges bg-lightred">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a class="me-3" href="{{ route('side-banners.edit', $banner->id) }}">
                                    <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="Edit">
                                </a>
                                <a class="me-3" href="{{ route('side-banners.show', $banner->id) }}">
                                    <img src="{{ asset('admin/assets/img/icons/eye.svg') }}" alt="View">
                                </a>
                                <form action="{{ route('side-banners.destroy', $banner->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this side banner?')">
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
