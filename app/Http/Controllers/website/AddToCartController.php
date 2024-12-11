<?php

namespace App\Http\Controllers\website;
use App\Models\Cart;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddToCartController extends Controller
{
    public function index(){
        $cart_products = Cart::with('product')->where('user_id',Auth::id())->get();
        $total_price = $cart_products->sum(function($product) {
            return $product->product->selling_price * $product->qty;
        });
        return view('website.cart.cart', compact('cart_products', 'total_price'));
    }

    public function cartCount() {
        $cart_count = Cart::where('user_id', Auth::id())->count();
        return response()->json(['cart_count' => $cart_count]);
    }


    public function addToCart(Request $request)
{
    $product_id = $request->input('product_id');
    $qty = $request->input('quantity', 1);  // الكمية ثابتة 1 إذا لم يتم تحديدها
    $user_id = Auth::id();

    if (Auth::check()) {
        $product = Product::find($product_id);
        
        // التأكد من وجود المنتج
        if ($product) {
            // التأكد من أن الكمية المطلوبة متوفرة في المخزون
            if ($qty > $product->qty) {
                return response()->json([
                    'msg' => 'The requested quantity is not available. Available quantity: ' . $product->qty,
                    'available_qty' => $product->qty
                ]);
            }

            // البحث عن المنتج في العربة الحالية للمستخدم
            $cartItem = Cart::where('product_id', $product_id)->where('user_id', $user_id)->first();
            
            if ($cartItem) {
                // تحديث الكمية إذا كان المنتج موجود بالفعل في العربة
                $cartItem->qty += $qty;
                $cartItem->save();
                return response()->json([
                    'icon' => 'success', // نوع الأيقونة
                    'msg' => 'Quantity updated successfully',
                    'product_name' => $product->name,
                    'price' => $product->selling_price
                ]);
            } else {
                // إضافة المنتج إلى العربة إذا لم يكن موجود
                Cart::create([
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'qty' => $qty,
                    'name' => $product->name,
                    'selling_price' => $product->selling_price
                ]);
                return response()->json([
                    'icon' => 'success', 
                    'msg' => $product->name . " Added to cart successfully",
                    'product_name' => $product->name,
                    'price' => $product->selling_price
                ]);
            }
        } else {
            return response()->json([
                'icon' => 'error',
                'msg' => 'Product not found'
            ]);
        }
    } else {
        return response()->json([
            'icon' => 'info',
            'msg' => 'Please <a href="' . route('login') . '">login</a> and continue to your page.'
        ]);
    }
}

public function update(Request $request)
{

// البحث عن المنتج في عربة التسوق
$cart = Cart::where('user_id', Auth::id())
            ->where('id', $request->id)
            ->first();

if ($cart) {
    // تحديث الكمية
    $cart->qty = $request->qty;
    $cart->save();


    // حساب الإجمالي الجزئي للمنتج
    $newTotalPrice = $cart->qty * $cart->product->selling_price;

    // حساب الإجمالي الكلي لعربة التسوق
    $cartTotal = Cart::where('user_id', Auth::id())->sum(function ($item) {
        return $item->qty * $item->product->selling_price;
    });

    // إرجاع الاستجابة
    return response()->json([
        'newTotalPrice' => $newTotalPrice,
        'cartTotal' => $cartTotal
    ]);
}

// إذا لم يتم العثور على المنتج
return response()->json(['error' => 'المنتج غير موجود'], 404);
}
public function destroy($id) {
        $cart = Cart::where(['id'=>$id,'user_id'=>Auth::id()])->first();
        $cart->delete();
        return redirect()->back()->with('success','product deleted successfully from cart');
    }
    

    


}
