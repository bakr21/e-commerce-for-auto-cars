@extends('admin.layouts.master')
@section('TitlePage', 'Edit Carousel Slide')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Edit Carousel Slide</h4>
            <h6>Update carousel slide information</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('carousels.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Title (English)<span class="text-danger">*</span></label>
                            <input type="text" name="title_en" value="{{ old('title_en', $carousel->title_en) }}" class="form-control @error('title_en') is-invalid @enderror" required>
                            @error('title_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Title (Arabic)<span class="text-danger">*</span></label>
                            <input type="text" name="title_ar" value="{{ old('title_ar', $carousel->title_ar) }}" class="form-control @error('title_ar') is-invalid @enderror" required>
                            @error('title_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Description (English)<span class="text-danger">*</span></label>
                            <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" required>{{ old('description_en', $carousel->description_en) }}</textarea>
                            @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Description (Arabic)<span class="text-danger">*</span></label>
                            <textarea name="description_ar" class="form-control @error('description_ar') is-invalid @enderror" required>{{ old('description_ar', $carousel->description_ar) }}</textarea>
                            @error('description_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Button Text (English)<span class="text-danger">*</span></label>
                            <input type="text" name="button_text_en" value="{{ old('button_text_en', $carousel->button_text_en) }}" class="form-control @error('button_text_en') is-invalid @enderror" required>
                            @error('button_text_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Button Text (Arabic)<span class="text-danger">*</span></label>
                            <input type="text" name="button_text_ar" value="{{ old('button_text_ar', $carousel->button_text_ar) }}" class="form-control @error('button_text_ar') is-invalid @enderror" required>
                            @error('button_text_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Button Link</label>
                            <input type="text" name="button_link" value="{{ old('button_link', $carousel->button_link) }}" class="form-control @error('button_link') is-invalid @enderror">
                            @error('button_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $carousel->sort_order) }}" class="form-control @error('sort_order') is-invalid @enderror">
                            @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Current Image</label>
                            <div>
                                <img src="{{ Storage::url($carousel->image) }}" alt="Current Image" class="img-fluid" style="max-width: 200px; max-height: 100px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>New Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
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
                                <input class="form-check-input" type="checkbox" name="status" value="1" {{ $carousel->status ? 'checked' : '' }}>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('carousels.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
