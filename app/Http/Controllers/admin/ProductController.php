<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
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
        $validated = $request->validated();
        $product = new Product();
        
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->slug = $request->slug;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->status = $request->status ? '1' : '0';
        $product->trend = $request->trend ? '1' : '0';
        $product->price = $request->price;
        $product->selling_price = $request->selling_price;
        $product->qty = $request->qty;
        $product->tax = $request->tax;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        
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
    $validated = $request->validated();

    $product->name = $request->name;
    $product->category_id = $request->category_id;
    $product->brand_id = $request->brand_id;
    $product->slug = $request->slug;
    $product->short_description = $request->short_description;
    $product->description = $request->description;
    $product->status = $request->status ? '1' : '0';
    $product->trend = $request->trend ? '1' : '0';
    $product->price = $request->price;
    $product->selling_price = $request->selling_price;
    $product->qty = $request->qty;
    $product->tax = $request->tax;
    $product->meta_title = $request->meta_title;
    $product->meta_description = $request->meta_description;
    $product->meta_keywords = $request->meta_keywords;

    $product->save();

    // التعامل مع الصور الجديدة
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
