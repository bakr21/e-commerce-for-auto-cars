@extends('admin.layouts.master')
@section('TitlePage', 'Edit Coupon')
@section('content')

<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Edit Coupon</h4>
            <h6>Update existing discount coupon</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('coupons.index') }}" class="btn btn-added">
                <img src="{{ asset('admin/assets/img/icons/reverse.svg') }}" alt="img" class="me-1">
                Back to Coupons
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $coupon->name) }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control">{{ old('description', $coupon->description) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Discount Type <span class="text-danger">*</span></label>
                            <select name="discount_type" class="form-control" required>
                                <option value="fixed" {{ old('discount_type', $coupon->discount_type) == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="percentage" {{ old('discount_type', $coupon->discount_type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Discount Amount <span class="text-danger">*</span></label>
                            <input type="number" name="discount_amount" step="0.01" class="form-control" value="{{ old('discount_amount', $coupon->discount_amount) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Minimum Order Amount</label>
                            <input type="number" name="min_order_amount" step="0.01" class="form-control" value="{{ old('min_order_amount', $coupon->min_order_amount) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Max Uses</label>
                            <input type="number" name="max_uses" class="form-control" value="{{ old('max_uses', $coupon->max_uses) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Max Uses Per User</label>
                            <input type="number" name="max_uses_user" class="form-control" value="{{ old('max_uses_user', $coupon->max_uses_user) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="is_active" class="form-control">
                                <option value="1" {{ old('is_active', $coupon->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', $coupon->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $coupon->start_date) }}">
                            <P>Starting from : {{ old('start_date', $coupon->start_date) }}</P>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $coupon->end_date) }}">
                            <P>Ending at : {{ old('end_date', $coupon->end_date) }}</P>
                        </div>
                    </div>



                    <div class="col-12 text-end mt-3">
                        <button type="submit" class="btn btn-primary">Update Coupon</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
