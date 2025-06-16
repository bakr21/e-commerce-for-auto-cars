<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\SaveRatingRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request, $catrgorySlug = null ){
        $categorySelected = '';

        $data['categories'] =  Category::orderby('name', 'ASC')->withCount(['activeProducts as products_count'])->where('is_showing',1)->get();
        $data['brands'] =  Brand::orderby('name', 'ASC')->withCount('products')->where('status',1)->get();
        $data['products'] = Product::where('status',1)->with('images', 'product_ratings', 'category', 'brand');
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

        $data['price'] = 10000;
        $priceMin = 5;
        $priceMax = 10000;

        if (!empty($request->get('price_min')) && !empty($request->get('price_max'))) {
            $priceMax = intval($request->get('price_max'));
            $priceMin = intval($request->get('price_min'));


            if ($priceMin <= $priceMax) {
                if ($priceMax == $data['price']) {
                    $data['products'] = $data['products']->whereBetween('selling_price', [$priceMin, 10000]);
                } else {
                    $data['products'] = $data['products']->whereBetween('selling_price', [$priceMin, $priceMax]);
                }
            }
        }


        if($request->get('sort') != ''){
            if ($request->get('sort') == 'lastest'){
                $data['products'] = $data['products']->orderby('id', 'DESC');
            } else if ($request->get('sort') == 'price_asc'){
                $data['products'] = $data['products']->orderby('selling_price', 'ASC');
            } else {
                $data['products'] = $data['products']->orderby('selling_price', 'DESC');
            }
        } else {
            $data['products'] = $data['products']->orderby('id', 'DESC');
        }
        $data['products'] = $data['products']
        ->withCount('product_ratings')
        ->withSum('product_ratings', 'rating')
        ->paginate(9);

        foreach ($data['products'] as $product) {
            $product->avgRating = $product->product_ratings_count > 0
                ? round($product->product_ratings_sum_rating / $product->product_ratings_count, 2)
                : 0.00;

            $product->avgRatingPer = ($product->avgRating * 100) / 5;
        }

        $data['categorySelected'] = $categorySelected;
        $data['priceMin'] = $priceMin;
        $data['priceMax'] = $priceMax;
        $data['sort'] = $request->get('sort');

        return view('website.shop', $data);
    }

    public function saveRating($id, SaveRatingRequest $request) {

        $existingReview = ProductRating::where('product_id', $id)
                                        ->where('email', $request->email)
                                        ->exists();

        if ($existingReview) {
            return response()->json([
                'status' => false,
                'title' => 'Duplicate Review',
                'message' => 'You have already submitted a review for this product.',
            ], 422);
        }

        $productRating = new ProductRating();
        $productRating->product_id = $id;
        $productRating->username = $request->name;
        $productRating->email = $request->email;
        $productRating->comment = $request->comment;
        $productRating->rating = $request->rating;
        $productRating->status = 0;
        $productRating->save();

        return response()->json([
            'status' => true,
            'title' => 'Thanks for Review',
            'message' => 'Thank you for reviewing the product. It will be displayed after admin approval.',
        ]);
    }



}
