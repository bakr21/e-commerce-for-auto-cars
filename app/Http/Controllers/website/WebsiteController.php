<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\AddToWishlistRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Catalog;
use App\Models\Carousel;
use App\Models\SideBanner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
{
    public function index() {
        $data['categories'] = Category::where('is_popular', 1)
            ->select('id', 'meta_title', 'meta_description', 'image', 'slug')
            ->withCount('products')
            ->take(12)
            ->get();

        $data['products'] = Product::where('trend', 1)
            ->select('id', 'meta_title','name', 'meta_description', 'price', 'selling_price', 'slug', 'category_id', 'brand_id')
            ->with('images', 'product_ratings', 'category', 'brand')
            ->withCount('product_ratings')
            ->withSum('product_ratings', 'rating')
            ->take(12)
            ->get();

        // Get active carousel slides
        $data['carousels'] = Carousel::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        // Get active side banners
        $data['sideBanners'] = SideBanner::where('status', 1)
            ->orderBy('position')
            ->get();

        return view('website.index', $data);
    }




    public function getCategories(){
        $data['categories'] = Category::where('is_showing',1)->withCount('products')->get();
        $data['products'] = Product::where('trend', 1)
        ->select('id', 'name', 'meta_description', 'price', 'selling_price', 'slug', 'category_id')
        ->with('images')->take(12)->get();
        return view('website.categories',$data);
    }

    public function getCategoryBySlug($slug)
    {
        // جيب الـ category مع المنتجات المرتبطة بيها
        $category = Category::where('slug', $slug)
            ->where('is_showing', 1)
            ->with(['products' => function ($query) {
                $query->where('status', 1)
                    ->select('id', 'meta_title', 'name', 'meta_description', 'price', 'selling_price', 'slug', 'category_id')
                    ->with('images')
                    ->withCount('product_ratings')
                    ->withSum('product_ratings', 'rating');
            }])
            ->withCount('products')
            ->firstOrFail();

        // جيب المنتجات من العلاقة
        $products = $category->products;

        return view('website.category', [
            'category' => $category,
            'products' => $products,
        ]);
    }



public function getProductBySlug($category_slug, $product_slug) {
    $category = Category::where('slug', $category_slug)->firstOrFail();

    $product = Product::with('category', 'brand', 'images', 'product_ratings')
                    ->where('slug', $product_slug)
                    ->withCount('product_ratings')
                    ->withSum('product_ratings', 'rating')
                    ->firstOrFail();



    $relatedProducts = Product::where('category_id', $product->category_id)
                                ->where('id', '!=', $product->id)
                                ->with('images', 'category', 'brand')
                                ->withCount('product_ratings')
                                ->withSum('product_ratings', 'rating')
                                ->take(8)
                                ->get();

    $trendingProducts = Product::where('trend', 1)
                                ->with('images', 'category', 'brand')
                                ->withCount('product_ratings')
                                ->withSum('product_ratings', 'rating')
                                ->take(10)
                                ->get();

    return view('website.product', [
        'product' => $product,
        'trendingProducts' => $trendingProducts,
        'categories' => Category::where('is_showing', 1)->withCount('products')->get(),
        'relatedProducts' => $relatedProducts,
        'keywords' => explode(',', $product->meta_keywords),
    ]);
}



    public function addToWishlist(AddToWishlistRequest $request) {
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

    public function catalogPage()
    {
        $catalogs = Catalog::where('status', 1)->latest()->get();

        return view('website.catalogs', compact('catalogs'));
    }

    public function downloadCatalog($id)
    {
        $catalog = Catalog::findOrFail($id);

        return Storage::download($catalog->file_path, $catalog->title_en . '.' . $catalog->file_type);
    }


}
