@extends('admin.layouts.master')
@section('TitlePage', 'Edit product '.$product->name.' - dashboard')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Product Edit</h4>
            <h6>Update your product</h6>
        </div>
        <div class="page-btn">
            <a href="{{route('products.index')}}" class="btn btn-added">
                <img src="{{asset('admin/assets/img/icons/reverse.svg')}}" alt="img" class="me-1">Product List
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- إضافة توجيه لطريقة التحديث -->
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Product Name <span class="text-danger">&#9913;</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $product->name) }}" >
                            @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Category <span class="text-danger">&#9913;</span></label>
                            <select name="category_id" class="select">
                                <option selected>please select</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
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
                            <label>Unit</label>
                            <select name="unit" class="select">
                                <option>Choose Unit</option>
                                <option value="piece" {{ old('unit', $product->unit) == 'piece' ? 'selected' : '' }}>Piece</option>
                                <option value="kg" {{ old('unit', $product->unit) == 'kg' ? 'selected' : '' }}>Kg</option>
                            </select>
                            @error('unit')
                                    <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" name="code" class="form-control" value="{{ old('code', $product->code) }}">
                            @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Minimum Qty</label>
                            <input type="number" name="min_qty" class="form-control" value="{{ old('min_qty', $product->min_qty) }}">
                            @error('min_qty')
                                    <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Quantity <span class="text-danger">&#9913;</span></label>
                            <input type="number" name="qty" class="form-control" value="{{ old('qty', $product->qty) }}">
                            @error('qty')
                                    <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Short Description <span class="text-danger">&#9913;</span></label>
                            <textarea class="form-control" name="short_description" rows="3" cols="3">{{ old('short_description', $product->short_description) }}</textarea>
                            @error('short_description')
                                    <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Description <span class="text-danger">&#9913;</span></label>
                            <textarea class="form-control" name="description">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Tax <span class="text-danger">&#9913;</span></label>
                            <input type="number" name="tax" class="form-control" value="{{ old('tax', $product->tax) }}">
                            @error('tax')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Price Selling <span class="text-danger">&#9913;</span></label>
                            <input type="number" name="selling_price" id="selling_price" class="form-control" value="{{ old('selling_price', $product->selling_price) }}">
                            @error('selling_price')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Price <span class="text-danger">&#9913;</span></label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}">
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
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label> Status</label>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="status" {{ old('status', $product->status) ? 'checked' : '' }}> Show in Website
                                </label>
                            </div>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label> Trend</label>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="trend" {{ old('trend', $product->trend) ? 'checked' : '' }}> Trend in Website
                                </label>
                            </div>
                            @error('trend')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
        
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label> Product Image <span class="text-danger">must at least one photo &#9913;</span></label>
                            <div class="image-upload">
                                <input type="file" name="images[]" id="images" class="form-control" multiple>
                                <div class="image-uploads">
                                    <img src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                            @error('images')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Preview Image</label>
                                <div class="preview-images rounded d-inline" style="width: 200px;">
                                    @foreach($product->images as $image)
                                        <img src="{{ Storage::url($image->image_path) }}" alt="img" style="width: 100px; height: 100px; margin: 5px;">
                                    @endforeach
                                </div> <!-- هنا سيتم عرض الصور -->
                            </div>
                        </div>
                    </div>
                    <h5 class="card-title">SEO Product</h5>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Slug <span class="text-danger">&#9913;</span></label>
                                    <div class="col-lg-9">
                                        <input type="text" name="slug" class="form-control" placeholder="Slug" value="{{ old('slug', $product->slug) }}" >
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Meta Title <span class="text-danger">&#9913;</span></label>
                                    <div class="col-lg-9">
                                        <input type="text" name="meta_title" class="form-control" placeholder="Meta Title" value="{{ old('meta_title', $product->meta_title) }}" >
                                        @error('meta_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Meta <br> Description <span class="text-danger">&#9913;</span></label>
                                    <div class="col-lg-9">
                                        <textarea name="meta_description" class="form-control" rows="2" placeholder="Meta Description">{{ old('meta_description', $product->meta_description) }}</textarea>
                                        @error('meta_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Meta <br> Keywords <span class="text-danger">&#9913;</span></label>
                                    <div class="col-lg-9">
                                        <textarea name="meta_keywords" class="form-control" rows="5" placeholder="Meta Keywords">{{ old('meta_keywords', $product->meta_keywords) }}</textarea>
                                        @error('meta_keywords')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2">Submit</button>
                        <a href="{{ route('products.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
        
    </div>
</div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
