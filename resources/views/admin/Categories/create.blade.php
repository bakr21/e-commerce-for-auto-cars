@extends('admin.layouts.master')
@section('TitlePage', 'Add Category')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Add Category</h4>
            <h6>Create new Category</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5 class="card-title">Category Information</h5>
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Category Name <span class="text-danger">&#9913;</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Category Code</label>
                            <input type="text" name="code" class="form-control" placeholder="Code">
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="5" placeholder="Description" required></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="is_showing">Show in Website</label>
                            <div class="input-group mb-3">
                                <input type="checkbox" id="is_showing" name="is_showing">
                            </div>
                            @error('is_showing')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="is_popular">Popular in Website</label>
                            <div class="input-group mb-3">
                                <input type="checkbox" id="is_popular" name="is_popular">
                            </div>
                            @error('is_popular')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Category Image <span class="text-danger">Must add one photo &#9913;</span></label>
                            <div class="image-upload">
                                <input class="form-control" type="file" name="image" required>
                                <div class="image-uploads">
                                    <img src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <h5 class="card-title">SEO Category</h5>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Slug <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="slug" class="form-control" placeholder="Slug" required>
                                    @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Meta Title <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="meta_title" class="form-control" placeholder="Meta Title" required>
                                    @error('meta_title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Meta Description <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <textarea name="meta_description" class="form-control" rows="2" placeholder="Meta Description" required></textarea>
                                    @error('meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Meta Keywords <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <textarea name="meta_keywords" class="form-control" rows="5" placeholder="Meta Keywords"></textarea>
                                    @error('meta_keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{route('categories.index')}}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
