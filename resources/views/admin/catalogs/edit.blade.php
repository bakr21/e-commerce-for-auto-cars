@extends('admin.layouts.master')
@section('TitlePage', 'Edit Catalog')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Edit Catalog</h4>
            <h6>Update catalog information</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('catalogs.update', $catalog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Title (English)<span class="text-danger">*</span></label>
                            <input type="text" name="title_en" value="{{ old('title_en', $catalog->title_en) }}" class="form-control @error('title_en') is-invalid @enderror" required>
                            @error('title_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Title (Arabic)<span class="text-danger">*</span></label>
                            <input type="text" name="title_ar" value="{{ old('title_ar', $catalog->title_ar) }}" class="form-control @error('title_ar') is-invalid @enderror" required>
                            @error('title_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Description (English)</label>
                            <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror">{{ old('description_en', $catalog->description_en) }}</textarea>
                            @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Description (Arabic)</label>
                            <textarea name="description_ar" class="form-control @error('description_ar') is-invalid @enderror">{{ old('description_ar', $catalog->description_ar) }}</textarea>
                            @error('description_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Current Cover Image</label>
                            <div>
                                <img src="{{ Storage::url($catalog->cover_image) }}" alt="Current Cover Image" class="img-fluid" style="max-width: 200px; max-height: 150px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Current File</label>
                            <div>
                                <a href="{{ route('website.catalog.download', $catalog->id) }}" class="btn btn-sm btn-info" target="_blank">
                                    <i class="fa fa-download"></i> Download {{ strtoupper($catalog->file_type) }} File
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>New Cover Image</label>
                            <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror">
                            <small class="text-muted">Recommended size: 600x400 pixels. Max file size: 2MB</small>
                            @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>New Catalog File (PDF or Excel)</label>
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                            <small class="text-muted">Allowed file types: PDF, Excel (.xlsx, .xls). Max file size: 10MB</small>
                            @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" value="1" {{ $catalog->status ? 'checked' : '' }}>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('catalogs.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
