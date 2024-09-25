<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Http\Requests\website\StoreCheckoutRequest;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingCharges;

class CheckoutController extends Controller
{
    public function index() {
        $carts = Cart::where('user_id', Auth::id())->get();
    
        $subTotal = $carts->sum(function($product) {
            return $product->product->selling_price * $product->qty;
        });
    
        $countries = Country::orderBy('name', 'ASC')->get();
    
        $customerAddress = CustomerAddress::where('user_id', Auth::user()->id)->first();
    
        $totalShippingCharge = 0;
        $grandTotal = $subTotal;
    
        if ($customerAddress != null) {
            $userCountry = $customerAddress->country_id;
            $shippingInfo = ShippingCharges::where('country_id', $userCountry)->first();
    
            $totalQty = $carts->sum('qty');
    
            if ($shippingInfo != null) {
                $totalShippingCharge = $totalQty * $shippingInfo->amount;
            } else {
                $totalShippingCharge = $totalQty * 50;
            }
    
            $grandTotal = $subTotal + $totalShippingCharge;
        }
    
        return view('website.checkout.index', compact(
            'carts',
            'subTotal',
            'countries',
            'customerAddress',
            'totalShippingCharge',
            'grandTotal'
        ));
    }
    

    
    
    public function processCheckout(Request $request){
        // step 1 => validation step
        $validator = Validator::make($request->all(), [
            'name' =>'required|string|min:5|max:255',
            'email' =>'required|string|email|max:255',
            'phone' =>'required',
            'address' =>'required|min:15',
            'country' =>'required',
            'city' =>'required',
            'state' =>'required',
            'zip' =>'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'message' => 'please fix the errors',
                'status' => false,
                'errors' => $validator->errors() 
            ]);
        }

        // step 2 => save user addresses
        $user = Auth::user();
        CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->phone,
                'address' => $request->address,
                'address2' => $request->address2,
                'country_id' => $request->country,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
            ]
        );

        // step 3 => save user addresses
        if($request->payment_method == 'cod'){
            
            $shipping = 0;
            $discount= 0;
            $userId = Auth::id(); 
            $cartItems = Cart::where('user_id', $userId)->with('product')->get();
            $subtotal = $cartItems->reduce(function ($carry, $item) {
                            return $carry + ($item->product->selling_price * $item->qty);
                        }, 0);
            $grandTotal = $subtotal + $shipping;
            $shippingInfo = ShippingCharges::where('country_id', $request->country)->first();

            $totalQty = 0;
            foreach ($cartItems as $item) {
                $totalQty += $item->qty;
            }

            if($shippingInfo != null){
                $shipping = $totalQty*$shippingInfo->amount;

                $grandTotal = $subtotal+$shipping;

            } 

            $order = new Order;
            $order->subtotal = $subtotal;
            $order->shipping = $shipping;
            $order->discount = $discount;
            $order->grand_total = $grandTotal;
            $order->payment_status = 'not paid';
            $order->status = 'pending';

            $order->user_id = $userId;
            $order->name = $request->name;
            $order->email = $request->email;
            $order->mobile = $request->phone;
            $order->address = $request->address;
            $order->address2 = $request->address2;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->zip = $request->zip;
            $order->notes = $request->notes;
            $order->country_id = $request->country;
            $order->save();  
            
            // step 4 => process save order items 
            $cartItems = Cart::with('product')
                        ->where('user_id', Auth::id())
                        ->get();

            foreach ($cartItems as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id; 
                $orderItem->product_id = $item->product_id;
                $orderItem->name = $item->name;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->selling_price;
                $orderItem->total = $item->qty * $item->selling_price;
                $orderItem->save();

                
                // step 6 => decrease product quantity
                $product = Product::find($item->product_id);
                $product->qty -= $item->qty;
                $product->save(); 
            }
            // send Email notification
            // orderEmail($order->id ,'customer');

            session()->flash('success', 'you haved completed order ');

            // step 5 => delete cart items
            Cart::where('user_id', Auth::id())->delete();

            return response()->json([
                'message' => 'Order saved successfully',
                'status' => true,
                'orderId' => $order->id,
            ]);



        } else {
                
        }
    }


    public function getOrderSummary(Request $request) {
        $carts = Cart::where('user_id', Auth::id())->get();
        $subTotal = $carts->sum(function($product) {
            return $product->product->selling_price * $product->qty;
        });
    
        $totalQty = 0;
        foreach ($carts as $item) {
            $totalQty += $item->qty;
        }
    
        if ($request->country_id > 0) {
            $shippingInfo = ShippingCharges::where('country_id', $request->country_id)->first();
    
            if ($shippingInfo) {
                $shippingCharge = $totalQty * $shippingInfo->amount;
                $grandTotal = $subTotal + $shippingCharge;
    
                return response()->json([
                    'status' => true,
                    'shippingCharge' => $shippingCharge,
                    'grandTotal' => $grandTotal,
                ]);
            } else {
                $shippingCharge = $totalQty * 50;
                $grandTotal = $subTotal + $shippingCharge;
    
                return response()->json([
                    'status' => true,
                    'message' => 'Rest of world shipping',
                    'shippingCharge' => $shippingCharge,
                    'grandTotal' => $grandTotal,
                ]);
            }
        } else {
            return response()->json([
                'status' => true,
                'shippingCharge' => 0,
                'grandTotal' => $subTotal,
            ]);
        }
    }
    

    public function thankYou($id) {
        $order = Order::find($id);
        return view('website.checkout.thanks', compact('id' , 'order'));
    }
}
