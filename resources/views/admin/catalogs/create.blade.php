@extends('admin.layouts.master')
@section('TitlePage', 'Add Catalog')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Add Catalog</h4>
            <h6>Create a new catalog</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('catalogs.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label>Description (English)</label>
                            <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror">{{ old('description_en') }}</textarea>
                            @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Description (Arabic)</label>
                            <textarea name="description_ar" class="form-control @error('description_ar') is-invalid @enderror">{{ old('description_ar') }}</textarea>
                            @error('description_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Cover Image<span class="text-danger">*</span></label>
                            <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" required>
                            <small class="text-muted">Recommended size: 600x400 pixels. Max file size: 2MB</small>
                            @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Catalog File (PDF or Excel)<span class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required>
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
                                <input class="form-check-input" type="checkbox" name="status" value="1" checked>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('catalogs.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
