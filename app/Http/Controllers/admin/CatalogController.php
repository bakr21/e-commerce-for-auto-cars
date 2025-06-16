<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCatalogRequest;
use App\Http\Requests\Admin\UpdateCatalogRequest;
use App\Models\Catalog;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catalogs = Catalog::latest()->get();
        return view('admin.catalogs.index', compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.catalogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCatalogRequest $request)
    {

        $coverImagePath = $request->file('cover_image')->store('public/catalogs/covers');
        $filePath = $request->file('file')->store('public/catalogs/files');

        // Determine file type
        $fileType = $request->file('file')->getClientOriginalExtension();

        Catalog::create([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'cover_image' => $coverImagePath,
            'file_path' => $filePath,
            'file_type' => $fileType,
            'status' => $request->status ? 1 : 0
        ]);

        flash()->success('Catalog added successfully', 'Success', ['timeOut' => 3000]);
        return redirect()->route('catalogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $catalog = Catalog::findOrFail($id);
        return view('admin.catalogs.show', compact('catalog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $catalog = Catalog::findOrFail($id);
        return view('admin.catalogs.edit', compact('catalog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatalogRequest $request, string $id)
    {
        $catalog = Catalog::findOrFail($id);

        if ($request->hasFile('cover_image')) {
            // Delete old image
            Storage::delete($catalog->cover_image);
            // Store new image
            $coverImagePath = $request->file('cover_image')->store('public/catalogs/covers');
            $catalog->cover_image = $coverImagePath;
        }

        if ($request->hasFile('file')) {
            // Delete old file
            Storage::delete($catalog->file_path);
            // Store new file
            $filePath = $request->file('file')->store('public/catalogs/files');
            $catalog->file_path = $filePath;
            // Update file type
            $catalog->file_type = $request->file('file')->getClientOriginalExtension();
        }

        $catalog->update([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'status' => $request->status ? 1 : 0
        ]);

        flash()->success('Catalog updated successfully', 'Success', ['timeOut' => 3000]);
        return redirect()->route('catalogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $catalog = Catalog::findOrFail($id);

        // Delete the cover image file
        Storage::delete($catalog->cover_image);

        // Delete the catalog file
        Storage::delete($catalog->file_path);

        // Delete the catalog record
        $catalog->delete();

        flash()->success('Catalog deleted successfully', 'Success', ['timeOut' => 3000]);
        return redirect()->route('catalogs.index');
    }
}
