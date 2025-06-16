@extends('admin.layouts.master')
@section('TitlePage', 'View Carousel Slide')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>View Carousel Slide</h4>
            <h6>View carousel slide details</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('carousels.index') }}" class="btn btn-primary">
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
                        <p>{{ $carousel->title_en }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Title (Arabic):</strong></label>
                        <p>{{ $carousel->title_ar }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Description (English):</strong></label>
                        <p>{{ $carousel->description_en }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Description (Arabic):</strong></label>
                        <p>{{ $carousel->description_ar }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Button Text (English):</strong></label>
                        <p>{{ $carousel->button_text_en }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Button Text (Arabic):</strong></label>
                        <p>{{ $carousel->button_text_ar }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Button Link:</strong></label>
                        <p>{{ $carousel->button_link ?: 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Sort Order:</strong></label>
                        <p>{{ $carousel->sort_order }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><strong>Status:</strong></label>
                        <p>
                            @if($carousel->status)
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
                        <p>{{ $carousel->created_at->format('Y-m-d H:i:s') }}</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label><strong>Image:</strong></label>
                        <div>
                            <img src="{{ Storage::url($carousel->image) }}" alt="Carousel Image" class="img-fluid" style="max-width: 400px; max-height: 200px;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-3">
                    <div class="form-group">
                        <a href="{{ route('carousels.edit', $carousel->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('carousels.destroy', $carousel->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this carousel slide?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
