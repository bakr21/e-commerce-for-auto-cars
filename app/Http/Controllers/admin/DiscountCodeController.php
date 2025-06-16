<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountCodeController extends Controller
{
    public function index()
    {
        $coupons = DiscountCoupon::with('creator')->latest()->get();
        return view('admin.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:discount_coupons,code',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'nullable|boolean',
            'discount_type' => 'required|in:fixed,percentage',
            'discount_amount' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'max_uses_user' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date|after_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        DiscountCoupon::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'discount_type' => $request->discount_type,
            'discount_amount' => $request->discount_amount,
            'min_order_amount' => $request->min_order_amount,
            'max_uses' => $request->max_uses,
            'max_uses_user' => $request->max_uses_user,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => $request->is_active ?? 1,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit(string $id)
    {
        $coupon = DiscountCoupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, string $id)
    {
        $coupon = DiscountCoupon::findOrFail($id);

        $request->validate([
            'code' => 'required|unique:discount_coupons,code,' . $coupon->id,
            'discount_type' => 'required|in:fixed,percentage',
            'discount_amount' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'max_uses_user' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $coupon->update([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'discount_type' => $request->discount_type,
            'discount_amount' => $request->discount_amount,
            'min_order_amount' => $request->min_order_amount,
            'max_uses' => $request->max_uses,
            'max_uses_user' => $request->max_uses_user,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => $request->is_active ?? 1,
        ]);

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(string $id)
    {
        $coupon = DiscountCoupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
