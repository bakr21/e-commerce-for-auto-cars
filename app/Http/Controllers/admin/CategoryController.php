<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = new Category();
        $category->name = ['ar'=> $request->name_ar , 'en' => $request->name_en];
        $category->slug = $request->slug;
        $category->description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar
        ];
        $category->is_showing = $request->is_showing ? '1' : '0';
        $category->is_popular = $request->is_popular ? '1' : '0';
        $category->image = $request->file('image')->store('public/categories');
        $category->meta_title = [
            'en' => $request->meta_title_en,
            'ar' => $request->meta_title_ar
        ];
        $category->meta_description = [
            'en' => $request->meta_description_en,
            'ar' => $request->meta_description_ar
        ];
        $category->meta_keywords = [
            'en' => $request->meta_keywords_en,
            'ar' => $request->meta_keywords_ar
        ];
        $category->save();


        flash()->success('Category added successfully', 'Success', ['timeOut' => 3000]);

        return redirect()->route('categories.index');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::delete($category->image);
            $category->image = $request->file('image')->store('public/categories');
        }

        $category->name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ];
        $category->slug = $request->slug;
        $category->description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar
        ];
        $category->is_showing = $request->is_showing ? '1' : '0';
        $category->is_popular = $request->is_popular ? '1' : '0';
        $category->meta_title = [
            'en' => $request->meta_title_en,
            'ar' => $request->meta_title_ar
        ];
        $category->meta_description = [
            'en' => $request->meta_description_en,
            'ar' => $request->meta_description_ar
        ];
        $category->meta_keywords = [
            'en' => $request->meta_keywords_en,
            'ar' => $request->meta_keywords_ar
        ];

        $category->save();

        flash()->success('Update category is done', 'Success Update', ['timeOut' => 20000]);
        return redirect()->route('categories.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $category = Category::findOrFail($id);

    if ($category->products()->count() > 0) {
        return redirect()->route('categories.index')->with('error', 'لا يمكن حذف التصنيف لأنه مرتبط بمنتجات.');
    }

    $category->delete();
    flash()->success('تم حذف التصنيف بنجاح.');
    return redirect()->route('categories.index');
}

}
