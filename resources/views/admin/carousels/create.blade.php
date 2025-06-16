@extends('admin.layouts.master')
@section('TitlePage', 'Add Carousel Slide')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Add Carousel Slide</h4>
            <h6>Create a new carousel slide</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('carousels.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Title (English)<span class="text-danger">*</span></label>
                            <input type="text" name="title_en" value="{{ old('title_en') }}" class="form-control @error('title_en') is-invalid @enderror" required>
                            @error('title_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Title (Arabic)<span class="text-danger">*</span></label>
                            <input type="text" name="title_ar" value="{{ old('title_ar') }}" class="form-control @error('title_ar') is-invalid @enderror" required>
                            @error('title_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Description (English)<span class="text-danger">*</span></label>
                            <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" required>{{ old('description_en') }}</textarea>
                            @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Description (Arabic)<span class="text-danger">*</span></label>
                            <textarea name="description_ar" class="form-control @error('description_ar') is-invalid @enderror" required>{{ old('description_ar') }}</textarea>
                            @error('description_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Button Text (English)<span class="text-danger">*</span></label>
                            <input type="text" name="button_text_en" value="{{ old('button_text_en') }}" class="form-control @error('button_text_en') is-invalid @enderror" required>
                            @error('button_text_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Button Text (Arabic)<span class="text-danger">*</span></label>
                            <input type="text" name="button_text_ar" value="{{ old('button_text_ar') }}" class="form-control @error('button_text_ar') is-invalid @enderror" required>
                            @error('button_text_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Button Link</label>
                            <input type="text" name="button_link" value="{{ old('button_link') }}" class="form-control @error('button_link') is-invalid @enderror">
                            @error('button_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control @error('sort_order') is-invalid @enderror">
                            @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Image<span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" required>
                            <small class="text-muted">Recommended size: 1200x430 pixels. Max file size: 2MB</small>
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" value="1" checked>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('carousels.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
