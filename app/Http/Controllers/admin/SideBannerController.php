<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSideBannerRequest;
use App\Http\Requests\Admin\UpdateSideBannerRequest;
use App\Models\SideBanner;
use Illuminate\Support\Facades\Storage;

class SideBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sideBanners = SideBanner::orderBy('position')->get();
        return view('admin.side-banners.index', compact('sideBanners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.side-banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSideBannerRequest $request)
    {

        $imagePath = $request->file('image')->store('public/side_banners');

        SideBanner::create([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'subtitle_en' => $request->subtitle_en,
            'subtitle_ar' => $request->subtitle_ar,
            'button_text_en' => $request->button_text_en,
            'button_text_ar' => $request->button_text_ar,
            'button_link' => $request->button_link,
            'image' => $imagePath,
            'status' => $request->status ? 1 : 0,
            'position' => $request->position
        ]);

        flash()->success('Side banner added successfully', 'Success', ['timeOut' => 3000]);
        return redirect()->route('side-banners.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sideBanner = SideBanner::findOrFail($id);
        return view('admin.side-banners.show', compact('sideBanner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sideBanner = SideBanner::findOrFail($id);
        return view('admin.side-banners.edit', compact('sideBanner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSideBannerRequest $request, string $id)
    {
        $sideBanner = SideBanner::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::delete($sideBanner->image);
            // Store new image
            $imagePath = $request->file('image')->store('public/side_banners');
            $sideBanner->image = $imagePath;
        }

        $sideBanner->update([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'subtitle_en' => $request->subtitle_en,
            'subtitle_ar' => $request->subtitle_ar,
            'button_text_en' => $request->button_text_en,
            'button_text_ar' => $request->button_text_ar,
            'button_link' => $request->button_link,
            'status' => $request->status ? 1 : 0,
            'position' => $request->position
        ]);

        flash()->success('Side banner updated successfully', 'Success', ['timeOut' => 3000]);
        return redirect()->route('side-banners.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sideBanner = SideBanner::findOrFail($id);

        // Delete the image file
        Storage::delete($sideBanner->image);

        // Delete the side banner record
        $sideBanner->delete();

        flash()->success('Side banner deleted successfully', 'Success', ['timeOut' => 3000]);
        return redirect()->route('side-banners.index');
    }
}
