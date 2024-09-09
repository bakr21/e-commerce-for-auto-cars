<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Trend Categories</span></h2>
    <div class="row px-xl-5 pb-3">
        @foreach ($categories as $category)
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="{{ route('website.category_slug' , $category->slug)}}">
                <div class="cat-item d-flex align-items-center mb-4">
                    <div class="overflow-hidden">
                        <img class="img-fluid image-trend-category" src="{{ Storage::url($category->image) }}" alt="{{ $category->image }}">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6>{{ $category->meta_title }}</h6>
                        <small class="text-body">{{$category->products_count}} products.</small>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        
    </div>
</div>