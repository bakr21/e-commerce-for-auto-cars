<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request, $catrgorySlug = null ){
        $categorySelected = '';

        $data['categories'] =  Category::orderby('name', 'ASC')->withCount('products')->where('is_showing',1)->get();
        $data['brands'] =  Brand::orderby('name', 'ASC')->withCount('products')->where('status',1)->get();
        $data['products'] = Product::where('status',1)->with('images');
        $data['brandsArray'] = [];
        $data['productsCount'] = $data['products']->count();
        $data['categoryCount'] = $data['categories']->count();
        $data['brandCount'] = $data['brands']->count();
        
        if (!empty($catrgorySlug)){
            $category = Category::where('slug',$catrgorySlug)->first();
            $data['products'] = $data['products']->where('category_id',$category->id);
            $categorySelected = $category->id;
        }
        
        if (!empty($request->get('brand'))){
            $data['brandsArray'] = explode(',',$request->get('brand'));
            $data['products'] = $data['products']->whereIn('brand_id',$data['brandsArray']);
        }

        if (!empty($request->get('search'))) {
            $data['products'] = $data['products']->where('name','like','%'.$request->get('search').'%');
        }
        
        $data['price'] = 5000;  
        $priceMin = 0; 
        $priceMax = 10000; 
        if (!empty($request->get('price_min')) && !empty($request->get('price_max'))) {
            $priceMax = intval($request->get('price_max'));
            $priceMin = intval($request->get('price_min'));
        
            if ($priceMin <= $priceMax) {
                if ($priceMax == $data['price']) {
                    $data['products'] = $data['products']->whereBetween('price', [$priceMin, 10000]);
                } else {
                    $data['products'] = $data['products']->whereBetween('price', [$priceMin, $priceMax]);
                }
            }
        }

        if($request->get('sort') != ''){
            if ($request->get('sort') == 'lastest'){
                $data['products'] = $data['products']->orderby('id', 'DESC');                
            } else if ($request->get('sort') == 'price_asc'){
                $data['products'] = $data['products']->orderby('price', 'ASC');
            } else {
                $data['products'] = $data['products']->orderby('price', 'DESC');
            }
        } else {
            $data['products'] = $data['products']->orderby('id', 'DESC');                
        }
        $data['products'] = $data['products']->paginate(10);
        $data['categorySelected'] = $categorySelected;
        $data['priceMin'] = $priceMin;
        $data['priceMax'] = $priceMax;
        $data['sort'] = $request->get('sort');

        return view('website.shop', $data);
    }
}
