@extends('admin.layouts.master')
@section('TitlePage', 'Create Coupon')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Coupon Add</h4>
            <h6>Create new coupon</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('coupons.index') }}" class="btn btn-added">
                <img src="{{ asset('admin/assets/img/icons/reverse.svg') }}" alt="img" class="me-1">Coupon List
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('coupons.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Code <span class="text-danger">*</span></label>
                        <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                        @error('code') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Max Uses</label>
                        <input type="number" name="max_uses" class="form-control" value="{{ old('max_uses') }}">
                        @error('max_uses') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Max Uses per User</label>
                        <input type="number" name="max_uses_user" class="form-control" value="{{ old('max_uses_user') }}">
                        @error('max_uses_user') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Discount Type</label>
                        <select name="discount_type" class="form-control">
                            <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                            <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                        </select>
                        @error('discount_type') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Discount Amount</label>
                        <input type="number" step="0.01" name="discount_amount" class="form-control" value="{{ old('discount_amount', 0) }}">
                        @error('discount_amount') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Minimum Order Amount</label>
                        <input type="number" step="0.01" name="min_order_amount" class="form-control" value="{{ old('min_order_amount', 0) }}">
                        @error('min_order_amount') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select name="is_active" class="form-control">
                            <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
                        @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                        @error('end_date') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Coupon</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
