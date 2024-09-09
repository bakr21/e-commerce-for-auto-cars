@extends('admin.layouts.master')
@section('TitlePage', 'Add Category')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Edit Category</h4>
            <h6>Edit product Category</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{route('categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h5 class="card-title">Personal Information</h5>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="form-label">Category Name <span class="text-danger">&#9913;</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{$category->name}}" required>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="5" placeholder="Description">{{$category->description}}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="is_showing">Show in Website</label>
                            <div class="input-group mb-3">
                                <input type="checkbox" id="is_showing" name="is_showing" {{($category->is_showing == 1) ?'checked' : ''}}>
                            </div>
                        </div>
                        <div class="col">
                            <label for="is_popular">Popular in Website</label>
                            <div class="input-group mb-3">
                                <input type="checkbox" id="is_popular" name="is_popular" {{($category->is_popular == 1) ?'checked' : ''}}>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Category Image</label>
                            <div class="image-upload">
                                <input class="form-control" type="file" name="image">
                                <div class="image-uploads">
                                    <img src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label >Image avialbe</label>
                        <div class="input-group justify-content-center">
                            <img src="{{Storage::url($category->image)}}" alt="" class="img-thumbnail" style="max-width:250px;">
                        </div>
                    </div>
                    <h5 class="card-title">SEO Category</h5>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Slug <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="slug" class="form-control" placeholder="Slug" value="{{$category->slug}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Meta Title <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="meta_title" class="form-control" placeholder="Meta Title" value="{{$category->meta_title}}"required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Meta Description <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <textarea name="meta_description" class="form-control" rows="2" placeholder="Meta Description">{{$category->meta_description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Meta Keywords <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <textarea name="meta_keywords" class="form-control" rows="5" placeholder="Meta Keywords">{{$category->meta_keywords}}</textarea>
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
