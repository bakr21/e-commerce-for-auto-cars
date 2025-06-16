@extends('admin.layouts.master')
@section('TitlePage', 'General Settings')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>General Setting</h4>
            <h6>Manage General Setting</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-7 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Site Name <span class="manitory">*</span></label>
                            <input type="text" name="site_name" value="{{ old('site_name', $settings->site_name ?? '') }}" placeholder="Enter Site Name" class="form-control">
                            <input type="text" name="site_name_ar" value="{{ old('site_name_ar', $settings->getTranslation('site_name', 'ar') ?? '') }}" placeholder="ادخل اسم الموقع بالعربي" class="form-control mt-2">
                            @error('site_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email<span class="manitory">*</span></label>
                            <input type="text" name="email" value="{{ old('email', $settings->email ?? '') }}" placeholder="Enter email" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="form-group">
                            <label>Site Image</label>
                            <div class="image-upload">
                                <input type="file" name="site_image" id="images" class="form-control">
                                <div class="image-uploads">
                                    <img src="{{asset('admin/assets/img/icons/upload.svg')}}" alt="img">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                                @error('site_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label>Preview Image</label>
                            @if ($settings->site_image ?? false)
                                <img src="{{ asset('storage/images/' . $settings->site_image) }}" alt="Site Image" class="img-thumbnail mt-2" width="150">
                            @endif
                            <div class="preview-images rounded d-inline" ></div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Company Description<span class="manitory">*</span></label>
                            <input type="text" name="company_description" value="{{ old('company_description', $settings->company_description ?? '') }}" placeholder="Enter Company Description" class="form-control">
                            <input type="text" name="company_description_ar" value="{{ old('company_description_ar', $settings->getTranslation('company_description', 'ar') ?? '') }}" placeholder="ادخل وصف الشركة بالعربي" class="form-control mt-2">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number', $settings->phone_number ?? '') }}" placeholder="Enter Phone Number">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Hotline<span class="manitory">*</span></label>
                            <input type="text" name="hotline" value="{{ old('hotline', $settings->hotline ?? '') }}" placeholder="Enter hotline">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Address <span class="manitory">*</span></label>
                            <input type="text" name="address" value="{{ old('address', $settings->address ?? '') }}" placeholder="Enter Address" class="form-control">
                            <input type="text" name="address_ar" value="{{ old('address_ar', $settings->getTranslation('address', 'ar') ?? '') }}" placeholder="ادخل العنوان بالعربي" class="form-control mt-2">
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Map Link<span class="manitory">*</span></label>
                            <input type="text" name="map_link" value="{{ old('map_link', $settings->map_link ?? '') }}" placeholder="Enter Map Link">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Facebook Link<span class="manitory">*</span></label>
                            <input type="text" name="facebook_link" value="{{ old('facebook_link', $settings->facebook_link ?? '') }}" placeholder="Enter Facebook Link">
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Whatsapp Number<span class="manitory">*</span></label>
                            <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $settings->whatsapp_number ?? '') }}" placeholder="Enter Whatsapp Link">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Twitter Link<span class="manitory">*</span></label>
                            <input type="text" name="twitter_link" value="{{ old('twitter_link', $settings->twitter_link ?? '') }}" placeholder="Enter Twitter Link">
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Linkedin Link<span class="manitory">*</span></label>
                            <input type="text" name="linkedin_link" value="{{ old('linkedin_link', $settings->linkedin_link ?? '') }}" placeholder="Enter Linkedin Link">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Working Hours<span class="manitory">*</span></label>
                            <input type="text" name="working_hours" value="{{ old('working_hours', $settings->working_hours ?? '') }}" placeholder="Enter Working Hours ( from 10 pm to 10 am )">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Save & update</button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection
