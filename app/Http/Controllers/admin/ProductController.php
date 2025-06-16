<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::select('id','category_id','name','status','trend','price','qty')->get();
        $image = Product::with('images');
        $brands = Brand::select('id', 'name')->get();
        return view('admin.products.index' , compact('products', 'image'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $brands = Brand::select('id', 'name')->get();
        return view('admin.products.create', compact('categories','brands'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $request->validated();
        $product = new Product();

        $product->setTranslation('name', 'ar', $request->input('name.ar'));
        $product->setTranslation('name', 'en', $request->input('name.en'));
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->slug = $request->slug;
        $product->setTranslation('short_description', 'ar', $request->input('short_description.ar'));
        $product->setTranslation('short_description', 'en', $request->input('short_description.en'));
        $product->setTranslation('description', 'ar', $request->input('description.ar'));
        $product->setTranslation('description', 'en', $request->input('description.en'));
        $product->status = $request->status;
        $product->trend = $request->trend;
        $product->price = $request->price;
        $product->selling_price = $request->selling_price;
        $product->minqty = $request->min_qty;
        $product->qty = $request->qty;
        $product->tax = $request->tax;
        $product->setTranslation('meta_title', 'ar', $request->input('meta_title.ar'));
        $product->setTranslation('meta_title', 'en', $request->input('meta_title.en'));
        $product->setTranslation('meta_description', 'ar', $request->input('meta_description.ar'));
        $product->setTranslation('meta_description', 'en', $request->input('meta_description.en'));
        $product->setTranslation('meta_keywords', 'ar', $request->input('meta_keywords.ar'));
        $product->setTranslation('meta_keywords', 'en', $request->input('meta_keywords.en'));

        $product->save();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/products');
                $product->images()->create(['image_path' => $path]);
            }
        }

        flash()->addSuccess('Add product successfully', 'Success Add', ['timeOut' => 20000]);
        return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // تحميل الصور المرتبطة بالمنتج
        $product->load('images');
        $categories = Category::select('id','name')->get();
        $brands = Brand::select('id', 'name')->get();
        return view('admin.products.edit', compact('product' , 'categories','brands'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
{
    $request->validated();

    $product->setTranslation('name', 'ar', $request->input('name.ar'));
    $product->setTranslation('name', 'en', $request->input('name.en'));
    $product->category_id = $request->category_id;
    $product->brand_id = $request->brand_id;
    $product->slug = $request->slug;
    $product->setTranslation('short_description', 'ar', $request->input('short_description.ar'));
    $product->setTranslation('short_description', 'en', $request->input('short_description.en'));
    $product->setTranslation('description', 'ar', $request->input('description.ar'));
    $product->setTranslation('description', 'en', $request->input('description.en'));
    $product->status = $request->status;
    $product->trend = $request->trend;
    $product->price = $request->price;
    $product->selling_price = $request->selling_price;
    $product->minqty = $request->min_qty;
    $product->qty = $request->qty;
    $product->tax = $request->tax;
    $product->setTranslation('meta_title', 'ar', $request->input('meta_title.ar'));
    $product->setTranslation('meta_title', 'en', $request->input('meta_title.en'));
    $product->setTranslation('meta_description', 'ar', $request->input('meta_description.ar'));
    $product->setTranslation('meta_description', 'en', $request->input('meta_description.en'));
    $product->setTranslation('meta_keywords', 'ar', $request->input('meta_keywords.ar'));
    $product->setTranslation('meta_keywords', 'en', $request->input('meta_keywords.en'));

    $product->save();


    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('public/products');
            $product->images()->create(['image_path' => $path]);
        }
    }

    flash()->addInfo('Product updated successfully', ['timeOut' => 20000]);
    return redirect()->route('products.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::where("id", $id)->delete();
        flash()->addWarning('Product deleted successfully', 'Delete Success', ['timeOut' => 20000]);
        return redirect()->route('products.index');
    }
}
