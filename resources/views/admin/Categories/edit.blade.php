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

                <h5 class="card-title">
                    <i class="fas fa-info-circle"></i> Category Information
                </h5>
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Category Name (English) <span class="text-danger">&#9913;</span></label>
                            <input type="text" name="name_en" class="form-control" placeholder="Category Name in English" value="{{ old('name_en', $category->getTranslation('name', 'en')) }}" required>
                            @error('name_en')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Category Name (Arabic) <span class="text-danger">&#9913;</span></label>
                            <input type="text" name="name_ar" class="form-control" placeholder="اسم التصنيف بالعربية" value="{{ old('name_ar', $category->getTranslation('name', 'ar')) }}" required dir="rtl">
                            @error('name_ar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Description (English) <span class="text-danger">&#9913;</span></label>
                            <textarea name="description_en" class="form-control" rows="4" placeholder="Category description in English" required>{{ old('description_en', $category->getTranslation('description', 'en')) }}</textarea>
                            @error('description_en')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Description (Arabic) <span class="text-danger">&#9913;</span></label>
                            <textarea name="description_ar" class="form-control" rows="4" placeholder="وصف التصنيف بالعربية" required dir="rtl">{{ old('description_ar', $category->getTranslation('description', 'ar')) }}</textarea>
                            @error('description_ar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
                    <h5 class="card-title">
                        <i class="fas fa-search"></i> SEO Category
                    </h5>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Slug <span class="text-danger">&#9913;</span></label>
                                <input type="text" name="slug" class="form-control" placeholder="category-slug" value="{{ old('slug', $category->slug) }}" required>
                                @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Meta Title (English) <span class="text-danger">&#9913;</span></label>
                                <input type="text" name="meta_title_en" class="form-control" placeholder="Meta Title in English" value="{{ old('meta_title_en', $category->getTranslation('meta_title', 'en')) }}" required>
                                @error('meta_title_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Meta Title (Arabic) <span class="text-danger">&#9913;</span></label>
                                <input type="text" name="meta_title_ar" class="form-control" placeholder="العنوان التعريفي بالعربية" value="{{ old('meta_title_ar', $category->getTranslation('meta_title', 'ar')) }}" required dir="rtl">
                                @error('meta_title_ar')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Meta Description (English) <span class="text-danger">&#9913;</span></label>
                                <textarea name="meta_description_en" class="form-control" rows="3" placeholder="Meta Description in English" required>{{ old('meta_description_en', $category->getTranslation('meta_description', 'en')) }}</textarea>
                                @error('meta_description_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Meta Description (Arabic) <span class="text-danger">&#9913;</span></label>
                                <textarea name="meta_description_ar" class="form-control" rows="3" placeholder="الوصف التعريفي بالعربية" required dir="rtl">{{ old('meta_description_ar', $category->getTranslation('meta_description', 'ar')) }}</textarea>
                                @error('meta_description_ar')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Meta Keywords (English) <span class="text-danger">&#9913;</span></label>
                                <textarea name="meta_keywords_en" class="form-control" rows="3" placeholder="keyword1, keyword2, keyword3" required>{{ old('meta_keywords_en', $category->getTranslation('meta_keywords', 'en')) }}</textarea>
                                @error('meta_keywords_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Meta Keywords (Arabic) <span class="text-danger">&#9913;</span></label>
                                <textarea name="meta_keywords_ar" class="form-control" rows="3" placeholder="كلمة مفتاحية، كلمة أخرى، كلمة ثالثة" required dir="rtl">{{ old('meta_keywords_ar', $category->getTranslation('meta_keywords', 'ar')) }}</textarea>
                                @error('meta_keywords_ar')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
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
