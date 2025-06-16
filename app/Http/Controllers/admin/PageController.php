<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePageRequest;
use App\Http\Requests\Admin\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::latest()->get();
        return view('admin.pages.index' , compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        $page = new Page;
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->content = $request->summernote; // Assuming summernote content is passed from the request
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $path = $request->image->storeAs('pages', $imageName, 'public');
            $page->image = $path;
        }
        $page->save();

        session()->flash('success', 'Page added successfully');

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('website.page', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page = Page::find($id);

        if (empty($page)){
            session()->flash('error', 'Record not found');
            return redirect()->route('pages.index');
        }

        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, string $id)
    {
        $page = Page::find($id);

        if (empty($page)){
            session()->flash('error', 'Record not found');
            return redirect()->route('pages.index');
        }

        // Update page details
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->content = $request->summernote;

        if ($request->hasFile('image')) {
            if ($page->image) {
                Storage::disk('public')->delete($page->image);
            }

            $imageName = time() . '.' . $request->image->extension();
            $path = $request->image->storeAs('pages', $imageName, 'public');
            $page->image = $path;
        }

        $page->save();

        session()->flash('success', 'Page updated successfully');
        return response()->json(['status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Page::find($id);

        if (empty($page)) {
            session()->flash('error', 'Record not found');
            return redirect()->route('pages.index');
        }

        if ($page->image) {
            Storage::disk('public')->delete($page->image);
        }
        $page->delete();

        session()->flash('success', 'page deleted successfully');

        return response()->json([
            'status' => true,
        ]);
    }
}
