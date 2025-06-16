@extends('website.layouts.master')
@section('TitlePage', 'Catalogs')
@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('home') }}">{{__('breadcrumb.home')}}</a>
                <span class="breadcrumb-item active">{{__('breadcrumb.catalogs')}}</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Catalogs Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <div class="section-title position-relative text-center mx-xl-5 mb-4">
                <h2 class="font-weight-bold"><span class="bg-secondary pr-3 ps-3">{{__('home.catalogs')}}</span></h2>
                <p class="text-muted">{{__('home.catalogs_description')}}</p>
            </div>
        </div>
    </div>

    <div class="row px-xl-5">
        @if($catalogs->count() > 0)
            @foreach($catalogs as $catalog)
            <div class="col-lg-4 col-md-6 col-sm-12 pb-1" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="{{ Storage::url($catalog->cover_image) }}" alt="{{ $catalog->title_en }}">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{ app()->getLocale() == 'en' ? $catalog->title_en : $catalog->title_ar }}</h6>
                        <p class="text-muted">{{ app()->getLocale() == 'en' ? $catalog->description_en : $catalog->description_ar }}</p>
                        <div class="d-flex justify-content-center">
                            <span class="badge {{ $catalog->file_type == 'pdf' ? 'bg-danger' : 'bg-success' }} text-white">
                                {{ strtoupper($catalog->file_type) }}
                            </span>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="{{ route('website.catalog.download', $catalog->id) }}" class="btn btn-sm text-dark p-0">
                            <i class="fas fa-download text-primary mr-1"></i>{{__('home.download')}}
                        </a>
                        <a href="{{ route('website.catalog.download', $catalog->id) }}" class="btn btn-sm text-dark p-0">
                            <i class="fas fa-eye text-primary mr-1"></i>{{__('home.view')}}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12 text-center py-5">
                <div class="alert alert-info">
                    <h4>{{__('home.no_catalogs')}}</h4>
                    <p>{{__('home.check_back_later')}}</p>
                </div>
            </div>
        @endif
    </div>
</div>
<!-- Catalogs End -->
@endsection
