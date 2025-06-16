@extends('admin.layouts.master')
@section('TitlePage', 'Create Product')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Product Add</h4>
            <h6>Create new product</h6>
        </div>
        <div class="page-btn">
            <a href="{{route('products.index')}}" class="btn btn-added">
                <img src="{{asset('admin/assets/img/icons/reverse.svg')}}" alt="img" class="me-1">Product List
            </a>
        </div>
    </div>
                {{-- =>> in pages must be created
                * validation
                * required
                * @erorr done
                * input complete
                --}}
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Basic Information -->
                <div class="row">
                    <div class="col-12">
                        <h4 class="mb-3 border-bottom pb-2">Basic Information</h4>
                    </div>
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Product Name (Arabic) <span class="text-danger">&#9913;</span></label>
                        <input type="text" name="name[ar]" class="form-control" placeholder="الاسم بالعربية" value="{{ old('name.ar') }}" >
                        @error('name.ar')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Product Name (English) <span class="text-danger">&#9913;</span></label>
                        <input type="text" name="name[en]" class="form-control" placeholder="Name in English" value="{{ old('name.en') }}" >
                        @error('name.en')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Category <span class="text-danger">&#9913;</span></label>
                        <select name="category_id" class="select">
                            <option selected>piease select</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                            @endforeach
                        </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Brand</label>
                        <select name="brand_id" class="select">
                            <option value="">Choose Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{$brand->name}}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Quantity <span class="text-danger">&#9913;</span></label>
                        <input type="number" name="qty" class="form-control" value="{{ old('qty') }}">
                        @error('qty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Minimum Quantity <span class="text-danger">&#9913;</span></label>
                        <input type="number" name="min_qty" class="form-control" value="{{ old('min_qty', 1) }}">
                        @error('min_qty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Short Description (Arabic) <span class="text-danger">&#9913;</span></label>
                        <input type="text" class="form-control" name="short_description[ar]" value="{{ old('short_description.ar') }}" placeholder="وصف قصير بالعربية"></input>
                        @error('short_description.ar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Short Description (English) <span class="text-danger">&#9913;</span></label>
                        <input type="text" class="form-control" name="short_description[en]" value="{{ old('short_description.en') }}" placeholder="Short description in English"></input>
                        @error('short_description.en')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Description (Arabic) <span class="text-danger">&#9913;</span></label>
                        <textarea class="form-control" name="description[ar]" id="summernote_ar">{{ old('description.ar', 'وصف المنتج بالعربية') }}</textarea>
                        @error('description.ar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Description (English) <span class="text-danger">&#9913;</span></label>
                        <textarea class="form-control" name="description[en]" id="summernote_en">{{ old('description.en', 'Product description in English') }}</textarea>
                        @error('description.en')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Tax <span class="text-danger">&#9913;</span></label>
                        <input type="number" name="tax" class="form-control" value="{{old('tax')}}">
                        @error('tax')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                </div>

                <!-- Pricing Information -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h4 class="mb-3 border-bottom pb-2">Pricing Information</h4>
                    </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Price Selling <span class="text-danger">&#9913;</span></label>
                        <input type="number" name="selling_price" id="selling_price" class="form-control" value="{{old('selling_price')}}">
                        @error('selling_price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Price <span class="text-danger">&#9913;</span></label>
                        <input type="number" name="price" id="price" class="form-control" value="{{old('price')}}">
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Profit</label>
                        <input type="number" name="profit" id="profit" class="form-control" disabled readonly>
                        @error('profit')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                </div>

                <!-- Product Settings -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h4 class="mb-3 border-bottom pb-2">Product Settings</h4>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status <span class="text-danger">&#9913;</span></label>
                            <select name="status" class="select">
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Trend <span class="text-danger">&#9913;</span></label>
                            <select name="trend" class="select">
                                <option value="1" {{ old('trend') == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('trend') == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            @error('trend')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- Product Images -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h4 class="mb-3 border-bottom pb-2">Product Images</h4>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Product Images <span class="text-danger">must have at least one photo &#9913;</span></label>
                            <div class="image-upload">
                                <input type="file" name="images[]" id="images" class="form-control" multiple>
                                <div class="image-uploads">
                                    <img src="{{asset('admin/assets/img/icons/upload.svg')}}" alt="img">
                                    <h4>Drag and drop files to upload</h4>
                                </div>
                            </div>
                            @error('images')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Preview Images</label>
                            <div class="preview-images rounded d-flex flex-wrap"></div> <!-- هنا سيتم عرض الصور -->
                        </div>
                    </div>
                </div>

                <!-- SEO Information -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h4 class="mb-3 border-bottom pb-2">SEO Information</h4>
                    </div>
                    <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Slug <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="slug" class="form-control" placeholder="Slug" value="{{ old('slug') }}" >
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Meta Title (Arabic) <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="meta_title[ar]" class="form-control" placeholder="عنوان الميتا بالعربية" value="{{ old('meta_title.ar') }}" >
                                    @error('meta_title.ar')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Meta Title (English) <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="meta_title[en]" class="form-control" placeholder="Meta Title in English" value="{{ old('meta_title.en') }}" >
                                    @error('meta_title.en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Meta Description (Arabic) <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <textarea name="meta_description[ar]" class="form-control" rows="2" placeholder="وصف الميتا بالعربية">{{ old('meta_description.ar') }}</textarea>
                                    @error('meta_description.ar')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Meta Description (English) <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <textarea name="meta_description[en]" class="form-control" rows="2" placeholder="Meta Description in English">{{ old('meta_description.en') }}</textarea>
                                    @error('meta_description.en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Meta Keywords (Arabic) <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <textarea name="meta_keywords[ar]" class="form-control" rows="3" placeholder="الكلمات المفتاحية بالعربية">{{ old('meta_keywords.ar') }}</textarea>
                                    @error('meta_keywords.ar')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Meta Keywords (English) <span class="text-danger">&#9913;</span></label>
                                <div class="col-lg-9">
                                    <textarea name="meta_keywords[en]" class="form-control" rows="3" placeholder="Meta Keywords in English">{{ old('meta_keywords.en') }}</textarea>
                                    @error('meta_keywords.en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Validation Errors -->
                @if ($errors->any())
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Submit Buttons -->
                <div class="row mt-4">
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg me-2">
                            <i class="fa fa-save me-2"></i> Create Product
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-danger btn-lg">
                            <i class="fa fa-times me-2"></i> Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Summernote editors
        $('#summernote_ar').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            placeholder: 'وصف المنتج بالعربية'
        });

        $('#summernote_en').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            placeholder: 'Product description in English'
        });

        // Calculate profit
        var priceInput = document.getElementById('price');
        var sellingPriceInput = document.getElementById('selling_price');
        var profitInput = document.getElementById('profit');

        function calculateProfit() {
            var price = parseFloat(priceInput.value) || 0;
            var sellingPrice = parseFloat(sellingPriceInput.value) || 0;
            var profit = sellingPrice - price;
            profitInput.value = profit.toFixed(2);
        }

        priceInput.addEventListener('input', calculateProfit);
        sellingPriceInput.addEventListener('input', calculateProfit);
    });
</script>

@endsection
