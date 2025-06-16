<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateReviewStatusRequest;
use App\Models\ProductRating;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = ProductRating::with('product')->latest()->get();
        return view('admin.reviews.index' , compact('reviews'));
    }

    public function updateStatus(UpdateReviewStatusRequest $request, $id)
    {
        $review = ProductRating::findOrFail($id);
        $review->status = $request->status;
        $review->save();

        return redirect()->back()->with('success', 'تم تحديث حالة التقييم بنجاح.');
    }
}
