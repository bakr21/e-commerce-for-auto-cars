@extends('admin.layouts.master')
@section('TitlePage', 'Add Category')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Product Add Category</h4>
            <h6>Create new product Category</h6>
        </div>
        <div class="page-btn">
            <a href="{{route('categories.index')}}" class="btn btn-added">
                <img src="{{asset('admin/assets/img/icons/reverse.svg')}}" alt="img" class="me-1">Categories list
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
                <h5 class="card-title">Personal Information</h5>
                
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Category Name</label>
                            <input type="text" name="name" class="form-control" value="{{$category->name}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Category Code</label>
                            <input type="text" name="code" class="form-control" value="{{$category->id}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="5"readonly>{{$category->description}}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="is_showing">Show in Website</label>
                            <div class="input-group mb-3">
                                @if($category->is_showing == 1)
                                <span class="badge bg-success">show</span>
                                @else
                                <span class="badge bg-danger">don't show</span>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <label for="is_popular">Popular in Website</label>
                            <div class="input-group mb-3">
                                @if($category->is_popular == 1)
                                <span class="badge bg-success">popular</span>
                                @else
                                <span class="badge bg-danger">don't popular</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <label >Category Image</label>
                        <div class="input-group justify-content-center">
                            <img src="{{Storage::url($category->image)}}" alt="" class="img-thumbnail" style="max-width:250px;">
                        </div>
                    </div>
                    <h5 class="card-title">SEO Category</h5>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Slug</label>
                                <div class="col-lg-9">
                                    <input type="text" name="slug" class="form-control" value="{{$category->slug}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Meta Title <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="meta_title" class="form-control" value="{{$category->meta_title}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Meta Description <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <textarea name="meta_description" class="form-control" readonly>{{$category->meta_description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Meta Keywords <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <textarea name="meta_keywords" class="form-control" readonly>{{$category->meta_keywords}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <a href="{{route('categories.index')}}" class="btn btn-primary">Back to categories list</a>
                    </div>
                </div>
            
        </div>
    </div>
</div>
@endsection
