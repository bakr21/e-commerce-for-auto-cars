<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:pages,slug',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // شرط رفع الصورة
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    
        $imageName = null;
    
        if ($request->hasFile('image')) {
            // إنشاء اسم فريد للصورة
            $imageName = time() . '.' . $request->image->extension();
            // تخزين الصورة في المجلد المخصص
            $request->image->move(public_path('images'), $imageName);
        }
        
        $page = new Page;
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->content = $request->summernote; // Assuming summernote content is passed from the request
        $page->image = $imageName; // Store the image path in the database
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
    public function update(Request $request, string $id)
    {
        $page = Page::find($id);

        if (empty($page)){
            session()->flash('error', 'Record not found');
            return redirect()->route('pages.index');
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:pages,slug,' . $id,
        ]);

        if($validator->passes()){
            $page->name = $request->name;
            $page->slug = $request->slug;
            $page->content = $request->summernote;
            $page->save();

            session()->flash('success', 'page updated successfully');
            return response()->json([
                'status' => true,
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
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

        $page->delete();

        session()->flash('success', 'page deleted successfully');
        
        return response()->json([
            'status' => true,
        ]);
    }
}
