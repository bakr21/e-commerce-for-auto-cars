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

    // CartController.php
    public function cartCount() {
        $cart_count = Cart::where('user_id', Auth::id())->count();
        return response()->json(['cart_count' => $cart_count]);
    }


    public function addToCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $qty = $request->input('quantity');
        $user_id = Auth::id();
    
        if (Auth::check()) {
            $product = Product::find($product_id);
            if ($product) {
                if ($qty > $product->qty) {
                    return response()->json([
                        'msg' => 'الكمية المطلوبة غير متوفرة. الكمية المتاحة: ' . $product->qty,
                        'available_qty' => $product->qty
                    ]);
                }
                $cartItem = Cart::where('product_id', $product_id)->where('user_id', $user_id)->first();
                if ($cartItem) {
                    // Update quantity if product is already in the cart
                    $cartItem->qty += $qty;
                    $cartItem->save();
                    return response()->json([
                        'msg' => 'تم تحديث الكمية بنجاح',
                        'product_name' => $product->name,
                        'price' => $product->selling_price
                    ]);
                } else {
                    Cart::create([
                        'user_id' => $user_id,
                        'product_id' => $product_id,
                        'qty' => $qty,
                        'name' => $product->name,
                        'selling_price' => $product->selling_price
                    ]);
                    return response()->json([
                        'msg' => $product->name . " تمت إضافته إلى العربة بنجاح",
                        'product_name' => $product->name,
                        'price' => $product->selling_price
                    ]);
                }
            } else {
                return response()->json(['msg' => 'لم يتم العثور على المنتج']);
            }
        } else {
            return response()->json(['msg' => 'يرجى <a href="' . route('login') . '">تسجيل الدخول</a> ومتابعة الصفحة الخاصة بك.']);
        }
    }
    


    



public function destroy($id) {
        $cart = Cart::where(['id'=>$id,'user_id'=>Auth::id()])->first();
        $cart->delete();
        return redirect()->back()->with('success','product deleted successfully from cart');
    }
    
public function update(Request $request) {
    $product = Cart::where('user_id', Auth::id())->where('id', $request->id)->first();
        if ($product) {
            $product->qty = $request->qty;
            $product->save();
            
            $newTotalPrice = $product->qty * $product->product->selling_price;
            
            // Update the cart total
            $cartTotal = Cart::where('user_id', Auth::id())->sum(function ($item) {
                return $item->qty * $item->product->selling_price;
            });

            return response()->json([
                'newTotalPrice' => $newTotalPrice,
                'cartTotal' => $cartTotal + 10 
            ]);
        }
        
        return response()->json(['error' => 'Product not found'], 404);
    }


}
