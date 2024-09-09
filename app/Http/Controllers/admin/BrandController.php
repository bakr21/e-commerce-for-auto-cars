<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands,slug',
            
        ]);

        if ($validator->passes()) {
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
    
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }

    public function edit($id,Request $request){
        $brand = Brand::find($id);

        if (empty($brand)){
            session()->flash('error', 'Record not found');
            return redirect()->route('brands.index');
        }

        return view('admin.brands.edit',compact('brand'));
    }

    public function update($id,Request $request){
        $brand = Brand::find($id);

        if (empty($brand)){
            session()->flash('error', 'Record not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
            ]);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands,slug,'.$brand->id.',id',
            
        ]);

        if ($validator->passes()) {

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
    
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
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
