<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{
    public function index(){
    $data['categories'] = Category::where('is_popular', 1)
        ->select('id', 'meta_title', 'meta_description', 'image', 'slug')
        ->withCount('products')
        ->get();

    $data['products'] = Product::where('trend', 1)
        ->select('id', 'meta_title', 'meta_description', 'price', 'selling_price', 'slug', 'category_id')
        ->with('images')->paginate(8);

    return view('website.index', $data);
    }

    public function getCategories(){
        $data['categories'] = Category::where('is_showing',1)->withCount('products')->get();
        $data['products'] = Product::where('trend', 1)
        ->select('id', 'meta_title', 'meta_description', 'price', 'selling_price', 'slug', 'category_id')
        ->with('images')->paginate(8);
        return view('website.categories',$data);
    }

    public function getCategoryBySlug($slug)
{
    $category = Category::with('products')
        ->where('slug', $slug)
        ->where('is_showing', 1)
        ->withCount('products')
        ->firstOrFail();

    $products = Product::where('status', 1)
        ->select('id', 'meta_title', 'meta_description', 'price', 'selling_price', 'slug', 'category_id')
        ->with('images');

    return view('website.category', [
        'category' => $category,
        'products' => $products,
    ]);
}

    

    public function getProductBySlug($category_slug, $product_slug) {
        $category = Category::where('slug', $category_slug)->first();
        if ($category) {
            $product = Product::where('slug', $product_slug)->first();
            if ($product) {
                $data['product'] = Product::with('category', 'images')->where('slug', $product_slug)->first();
                $data['trendingProducts'] = Product::where('trend', 1)->with('images')->take(8)->get();
                $data['keywords'] = explode(',', $data['product']->meta_keywords);
                return view('website.product', $data);
            } else {
                return redirect('/')->with('error', 'There is no product');
            }
        } else {
            return redirect('/')->with('error', 'There is no category');
        }
    }
    
    public function addToWishlist(Request $request) {
        // تحقق مما إذا كان المستخدم مسجل الدخول
        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'redirect' => route('login')
            ], 401); // حالة 401 تعني أن المستخدم غير مصادق عليه
        }
    
        // تحقق مما إذا كان المنتج موجود بالفعل في قائمة المفضلة
        $existsInWishlist = Wishlist::where('user_id', Auth::id())
                                    ->where('product_id', $request->id)
                                    ->exists();
    
        if ($existsInWishlist) {
            return response()->json([
                'status' => false,
                'message' => 'This product is already in your wishlist.'
            ]);
        }

        $product = Product::where('id', $request->id)->first();

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found.'
            ]);
        }
    
        // إضافة المنتج إلى قائمة المفضلة
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->id
        ]);
    
        return response()->json([
            'status' => true,
            'message' => 'Product added to wishlist successfully.'
        ]);
    }
    
    
    


}
