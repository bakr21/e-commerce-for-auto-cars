<?php

namespace App\Http\Controllers\website;
use App\Models\Cart;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Website\AddToCartRequest;
use App\Http\Requests\Website\UpdateCartRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


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
        $cart_count = Cart::where('user_id', Auth::id())->sum('qty');
        return response()->json(['cart_count' => $cart_count]);
    }



    public function addToCart(AddToCartRequest $request)
    {
        $product_id = $request->input('product_id');
        $qty = $request->input('quantity', 1);
        $user_id = Auth::id();
        $product = Product::find($product_id);

        // التأكد من وجود المنتج
        if (!$product) {
            return response()->json([
                'icon' => 'error',
                'msg' => __('cart.product_not_found')
            ]);
        }

        // التأكد من أن الكمية المطلوبة متوفرة في المخزون
        if ($qty > $product->qty) {
            return response()->json([
                'msg' => __('cart.qty_not_available', ['qty' => $product->qty]),
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
                'icon' => 'success',
                'msg' => __('cart.qty_updated'),
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
                'msg' => __('cart.added_successfully', ['product' => $product->name]),
                'product_name' => $product->name,
                'price' => $product->selling_price
            ]);
        }
    }

public function update(UpdateCartRequest $request)
{
    Log::info('Request received:', $request->all());

    $cart = Cart::where('user_id', Auth::id())
                ->where('product_id', $request->id) // استخدام product_id بدلاً من id
                ->first();

    if (!$cart) {
        return response()->json([
            'success' => false,
            'message' => 'Product not found in cart.'
        ], 404);
    }

    $cart->update(['qty' => $request->qty]);

    $newTotalPrice = $cart->qty * $cart->product->selling_price;
    $cartTotal = $this->calculateCartTotal();

    return response()->json([
        'success' => true,
        'newTotalPrice' => $newTotalPrice,
        'cartTotal' => $cartTotal,
        'message' => 'Cart updated successfully.'
    ]);
}


public function destroy($id) {
        $cart = Cart::where(['id'=>$id,'user_id'=>Auth::id()])->first();
        $cart->delete();
        return redirect()->back()->with('success', __('cart.product_deleted_from_cart'));
    }

}
