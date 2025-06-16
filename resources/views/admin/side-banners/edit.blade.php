@extends('admin.layouts.master')
@section('TitlePage', 'Edit Side Banner')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Edit Side Banner</h4>
            <h6>Update side banner information</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('side-banners.update', $sideBanner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Title (English)<span class="text-danger">*</span></label>
                            <input type="text" name="title_en" value="{{ old('title_en', $sideBanner->title_en) }}" class="form-control @error('title_en') is-invalid @enderror" required>
                            @error('title_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Title (Arabic)<span class="text-danger">*</span></label>
                            <input type="text" name="title_ar" value="{{ old('title_ar', $sideBanner->title_ar) }}" class="form-control @error('title_ar') is-invalid @enderror" required>
                            @error('title_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Subtitle (English)<span class="text-danger">*</span></label>
                            <input type="text" name="subtitle_en" value="{{ old('subtitle_en', $sideBanner->subtitle_en) }}" class="form-control @error('subtitle_en') is-invalid @enderror" required>
                            @error('subtitle_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Subtitle (Arabic)<span class="text-danger">*</span></label>
                            <input type="text" name="subtitle_ar" value="{{ old('subtitle_ar', $sideBanner->subtitle_ar) }}" class="form-control @error('subtitle_ar') is-invalid @enderror" required>
                            @error('subtitle_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Button Text (English)<span class="text-danger">*</span></label>
                            <input type="text" name="button_text_en" value="{{ old('button_text_en', $sideBanner->button_text_en) }}" class="form-control @error('button_text_en') is-invalid @enderror" required>
                            @error('button_text_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Button Text (Arabic)<span class="text-danger">*</span></label>
                            <input type="text" name="button_text_ar" value="{{ old('button_text_ar', $sideBanner->button_text_ar) }}" class="form-control @error('button_text_ar') is-invalid @enderror" required>
                            @error('button_text_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Button Link</label>
                            <input type="text" name="button_link" value="{{ old('button_link', $sideBanner->button_link) }}" class="form-control @error('button_link') is-invalid @enderror">
                            @error('button_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Position<span class="text-danger">*</span></label>
                            <select name="position" class="form-control @error('position') is-invalid @enderror" required>
                                <option value="1" {{ old('position', $sideBanner->position) == 1 ? 'selected' : '' }}>Top</option>
                                <option value="2" {{ old('position', $sideBanner->position) == 2 ? 'selected' : '' }}>Bottom</option>
                            </select>
                            @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Current Image</label>
                            <div>
                                <img src="{{ Storage::url($sideBanner->image) }}" alt="Current Image" class="img-fluid" style="max-width: 200px; max-height: 100px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>New Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            <small class="text-muted">Recommended size: 600x200 pixels. Max file size: 2MB</small>
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" value="1" {{ $sideBanner->status ? 'checked' : '' }}>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('side-banners.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
