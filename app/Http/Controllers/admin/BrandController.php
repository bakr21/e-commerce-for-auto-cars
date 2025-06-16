<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();
        // Display all brands
        return view('admin.brands.index', compact('brands'));
    }


    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(StoreBrandRequest $request){
        $brand = new Brand;
        $brand->name    = $request->name;
        $brand->slug    = $request->slug;
        $brand->status    = $request->status;
        // if ($request->hasFile('image')) {
        //     $brand->image = $request->file('image')->store('public/brand');
        // }
        $brand->save();
        session()->flash('success', 'Brand added successfully');
        return response()->json([
            'status' => true,
        ]);

    }

    public function edit($id){
        $brand = Brand::find($id);

        if (empty($brand)){
            session()->flash('error', 'Record not found');
            return redirect()->route('brands.index');
        }

        return view('admin.brands.edit',compact('brand'));
    }

    public function update($id, UpdateBrandRequest $request){
        $brand = Brand::find($id);

        if (empty($brand)){
            session()->flash('error', 'Record not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
            ]);
        }

        $brand->name    = $request->name;
        $brand->slug    = $request->slug;
        $brand->status    = $request->status;
        // if ($request->hasFile('image')) {
        //     $brand->image = $request->file('image')->store('public/brand');
        // }
        $brand->save();
        session()->flash('success', 'Brand update successfully');
        return response()->json([
            'status' => true,
        ]);
    }

    public function destroy($id){
        $brand = Brand::find($id);

        if (empty($brand)) {
            session()->flash('error', 'Record not found');
            return redirect()->route('brands.index');
        }

        $brand->delete();

        session()->flash('success', 'Brand deleted successfully');
        return redirect()->route('brands.index');
    }

}
