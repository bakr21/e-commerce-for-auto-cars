<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRegisterRequest;
use App\Http\Requests\StoreLoginRequest;
use App\Mail\WelcomeEmail;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function __construct()
    {
        // Pages that can be accessed without logging in
        $this->middleware('auth')->except(['login', 'loginAction','register', 'registerSave','logout']);
    }

    public function register (){
        return view('Auth.register');
    }

    
    public function registerSave(StoreRegisterRequest $request) {
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'addres'   => $request->address,
            'region'    => $request->region,
            'type'      => "0"
        ]);
    
        Mail::to($user->email)->send(new WelcomeEmail($user));
    
        return redirect()->route('login');
    }
    

    public function login (){
        return view('Auth.login');
    }

    public function loginAction(StoreLoginRequest $request) {
        
        
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
        
        $request->session()->regenerate();
    
        
        if (auth()->user()->type == 'admin') {
            return redirect()->intended('dashboard');
        } else {
            return redirect()->intended('/');
        }
    }
    
    public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }

    public function profile(){
        $userID = Auth::user()->id;

        $user = User::where('id',$userID)->first();
        $countries = Country::orderBy('name', 'ASC')->get();
        $customerAddress = CustomerAddress::where('user_id',$user->id)->first();

        return view('website.account.profile' , compact('user','countries' , 'customerAddress'));
    }
    
    public function updateprofile(Request $request){
        $userID = Auth::user()->id;
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$userID.',id',
            'phone' => 'required',
            'address' => 'required',
            'region' => 'required',
        ]);

        if ($validator->passes()) {
            $user = User::find($userID);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->addres = $request->address;
            $user->region = $request->region;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully',
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function updateAddress(Request $request){
        $userID = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'billing_name' =>'required|string|min:5|max:255',
            'billing_email' =>'required|string|email|max:255',
            'billing_phone' =>'required',
            'billing_address' =>'required|min:15',
            'country_id' =>'required',
            'city' =>'required',
            'state' =>'required',
            'zip' =>'required',
        ]);

        if ($validator->passes()) {
            CustomerAddress::updateOrCreate(
                ['user_id' => $userID],
                [
                    'user_id' => $userID,
                    'name' => $request->billing_name,
                    'email' => $request->billing_email,
                    'mobile' => $request->billing_phone,
                    'address' => $request->billing_address,
                    'address2' => $request->address2,
                    'country_id' => $request->country_id,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                ]
            );

            return response()->json([
                'status' => true,
                'message' => 'Address updated successfully',
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function orders(){
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at','desc')->get();
        return view('website.account.orders' , compact('orders'));
    }

    public function orderDetail($id){
        $user = Auth::user();
        $data['order'] = Order::where('user_id',$user->id)->where('id',$id)->first();
        $data['orderItems'] = OrderItem::where('order_id', $data['order']->id)->with('product.images')->get();
        return view('website.account.order_detail', $data);
    }

    public function wishlist(){
        $wishlists = Wishlist::where('user_id', Auth::user()->id)->with('product')->get();
        return view('website.account.wishlist', compact('wishlists'));

    }

    public function removeProductFromWishlist(Request $request){
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->id)->first();
        if ($wishlist == null){
            return response()->json([
                'status' => true,
                'message' => 'This product is already in your wishlist.'
            ]);
        } else {
            $wishlist->delete();
            return response()->json([
                'status' => true,
                'message' => 'Product removed from wishlist.'
            ]); 
        }
    }

    public function wishlistCount(){
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        return response()->json(['count' => $wishlistCount]);
    }



}
