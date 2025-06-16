<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCarouselRequest;
use App\Http\Requests\Admin\UpdateCarouselRequest;
use App\Models\Carousel;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carousels = Carousel::orderBy('sort_order')->get();
        return view('admin.carousels.index', compact('carousels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.carousels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarouselRequest $request)
    {

        $imagePath = $request->file('image')->store('public/carousels');

        Carousel::create([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'button_text_en' => $request->button_text_en,
            'button_text_ar' => $request->button_text_ar,
            'button_link' => $request->button_link,
            'image' => $imagePath,
            'status' => $request->status ? 1 : 0,
            'sort_order' => $request->sort_order ?? 0
        ]);

        flash()->success('Carousel slide added successfully', 'Success', ['timeOut' => 3000]);
        return redirect()->route('carousels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('admin.carousels.show', compact('carousel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('admin.carousels.edit', compact('carousel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarouselRequest $request, string $id)
    {
        $carousel = Carousel::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::delete($carousel->image);
            // Store new image
            $imagePath = $request->file('image')->store('public/carousels');
            $carousel->image = $imagePath;
        }

        $carousel->update([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'button_text_en' => $request->button_text_en,
            'button_text_ar' => $request->button_text_ar,
            'button_link' => $request->button_link,
            'status' => $request->status ? 1 : 0,
            'sort_order' => $request->sort_order ?? 0
        ]);

        flash()->success('Carousel slide updated successfully', 'Success', ['timeOut' => 3000]);
        return redirect()->route('carousels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $carousel = Carousel::findOrFail($id);

        // Delete the image file
        Storage::delete($carousel->image);

        // Delete the carousel record
        $carousel->delete();

        flash()->success('Carousel slide deleted successfully', 'Success', ['timeOut' => 3000]);
        return redirect()->route('carousels.index');
    }
}
