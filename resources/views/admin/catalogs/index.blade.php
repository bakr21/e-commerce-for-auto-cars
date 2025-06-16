@extends('admin.layouts.master')
@section('TitlePage', 'Catalogs Management')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Catalogs List</h4>
            <h6>Manage your catalogs</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('catalogs.create') }}" class="btn btn-added">
                <i class="fa fa-plus"></i> Add Catalog
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
                            <th>Cover Image</th>
                            <th>Title (EN)</th>
                            <th>Title (AR)</th>
                            <th>File Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($catalogs as $catalog)
                        <tr>
                            <td>{{ $catalog->id }}</td>
                            <td>
                                <img src="{{ Storage::url($catalog->cover_image) }}" alt="Catalog Cover" class="img-fluid" style="max-width: 100px; max-height: 60px;">
                            </td>
                            <td>{{ $catalog->title_en }}</td>
                            <td>{{ $catalog->title_ar }}</td>
                            <td>
                                <span class="badges {{ $catalog->file_type == 'pdf' ? 'bg-lightred' : 'bg-lightgreen' }}">
                                    {{ strtoupper($catalog->file_type) }}
                                </span>
                            </td>
                            <td>
                                @if($catalog->status)
                                <span class="badges bg-lightgreen">Active</span>
                                @else
                                <span class="badges bg-lightred">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a class="me-3" href="{{ route('catalogs.edit', $catalog->id) }}">
                                    <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="Edit">
                                </a>
                                <a class="me-3" href="{{ route('catalogs.show', $catalog->id) }}">
                                    <img src="{{ asset('admin/assets/img/icons/eye.svg') }}" alt="View">
                                </a>
                                <a class="me-3" href="{{ route('website.catalog.download', $catalog->id) }}" target="_blank">
                                    <img src="{{ asset('admin/assets/img/icons/download.svg') }}" alt="Download">
                                </a>
                                <form action="{{ route('catalogs.destroy', $catalog->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this catalog?')">
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
