@extends('admin.layouts.master')
@section('TitlePage', 'View Side Banner')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>View Side Banner</h4>
            <h6>View side banner details</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('side-banners.index') }}" class="btn btn-primary">
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
                        <p>{{ $sideBanner->title_en }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Title (Arabic):</strong></label>
                        <p>{{ $sideBanner->title_ar }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Subtitle (English):</strong></label>
                        <p>{{ $sideBanner->subtitle_en }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Subtitle (Arabic):</strong></label>
                        <p>{{ $sideBanner->subtitle_ar }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Button Text (English):</strong></label>
                        <p>{{ $sideBanner->button_text_en }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Button Text (Arabic):</strong></label>
                        <p>{{ $sideBanner->button_text_ar }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Button Link:</strong></label>
                        <p>{{ $sideBanner->button_link ?: 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Position:</strong></label>
                        <p>
                            @if($sideBanner->position == 1)
                            <span class="badges bg-lightblue">Top</span>
                            @else
                            <span class="badges bg-lightyellow">Bottom</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Status:</strong></label>
                        <p>
                            @if($sideBanner->status)
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
                        <p>{{ $sideBanner->created_at->format('Y-m-d H:i:s') }}</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label><strong>Image:</strong></label>
                        <div>
                            <img src="{{ Storage::url($sideBanner->image) }}" alt="Side Banner Image" class="img-fluid" style="max-width: 400px; max-height: 200px;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-3">
                    <div class="form-group">
                        <a href="{{ route('side-banners.edit', $sideBanner->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('side-banners.destroy', $sideBanner->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this side banner?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
