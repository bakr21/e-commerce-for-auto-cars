@extends('admin.layouts.master')
@section('TitlePage', 'Coupons')
@section('content')

<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Coupon List</h4>
            <h6>Manage your discount coupons</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('coupons.create') }}" class="btn btn-added">
                <img src="{{ asset('admin/assets/img/icons/plus.svg') }}" alt="img" class="me-1">Add Coupon
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Discount</th>
                            <th>Type</th>
                            <th>Active</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coupons as $key => $coupon)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->name ?? '-' }}</td>
                            <td>
                                @if ($coupon->discount_type == 'percentage')
                                    {{ $coupon->discount_amount }} %
                                @else
                                    {{ $coupon->discount_amount }} EGP
                                @endif
                            </td>
                            <td>{{ ucfirst($coupon->discount_type) }}</td>
                            <td>
                                @if($coupon->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $coupon->start_date ?? '-' }}</td>
                            <td>{{ $coupon->end_date ?? '-' }}</td>
                            <td>{{ $coupon->creator->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
