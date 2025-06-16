@extends('admin.layouts.master')
@section('TitlePage', 'View Catalog')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>View Catalog</h4>
            <h6>View catalog details</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('catalogs.index') }}" class="btn btn-primary">
                <i class="fa fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Title (English):</strong></label>
                        <p>{{ $catalog->title_en }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Title (Arabic):</strong></label>
                        <p>{{ $catalog->title_ar }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Description (English):</strong></label>
                        <p>{{ $catalog->description_en ?: 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Description (Arabic):</strong></label>
                        <p>{{ $catalog->description_ar ?: 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>File Type:</strong></label>
                        <p>
                            <span class="badges {{ $catalog->file_type == 'pdf' ? 'bg-lightred' : 'bg-lightgreen' }}">
                                {{ strtoupper($catalog->file_type) }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Status:</strong></label>
                        <p>
                            @if($catalog->status)
                            <span class="badges bg-lightgreen">Active</span>
                            @else
                            <span class="badges bg-lightred">Inactive</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Created At:</strong></label>
                        <p>{{ $catalog->created_at->format('Y-m-d H:i:s') }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>File:</strong></label>
                        <p>
                            <a href="{{ route('website.catalog.download', $catalog->id) }}" class="btn btn-sm btn-info" target="_blank">
                                <i class="fa fa-download"></i> Download {{ strtoupper($catalog->file_type) }} File
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label><strong>Cover Image:</strong></label>
                        <div>
                            <img src="{{ Storage::url($catalog->cover_image) }}" alt="Catalog Cover Image" class="img-fluid" style="max-width: 400px; max-height: 300px;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-3">
                    <div class="form-group">
                        <a href="{{ route('catalogs.edit', $catalog->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('catalogs.destroy', $catalog->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this catalog?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
