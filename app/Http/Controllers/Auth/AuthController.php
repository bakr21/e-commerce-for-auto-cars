<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreRegisterRequest;
use App\Http\Requests\Admin\StoreLoginRequest;
use App\Jobs\SendWelcomeEmailJob;
use App\Jobs\SendPasswordResetLinkJob;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Cart;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;



class AuthController extends Controller
{
    public function __construct()
    {
        // Pages that can be accessed without logging in
        $this->middleware('auth')->except([
            'login',
            'loginAction',
            'register',
            'registerSave',
            'logout',
            'forgotPassword',
            'processForgetPassword',
            'resetPassword',
            'processResetPassword'
        ]);
    }

    public function register()
    {
    return view('auth.register');
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

        if (!$user) {
            return back()->withErrors(['error' => 'Failed to register user.']);
        }

        try {
            // Since we're using sync queue driver in development, this will send the email immediately
            SendWelcomeEmailJob::dispatch($user);

            // For debugging, let's also log that we attempted to send the email
            \Illuminate\Support\Facades\Log::info('Welcome email dispatched for user: ' . $user->email);
        } catch (\Exception $e) {
            // Log the error but don't stop the registration process
            \Illuminate\Support\Facades\Log::error('Failed to send welcome email: ' . $e->getMessage());
        }
        $user->sendEmailVerificationNotification();
        event(new Registered($user));
        Auth::login($user);

        if ($user->type === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }


    public function login (){
        return view('auth.login');
    }

    public function loginAction(StoreLoginRequest $request)
{
    // Attempt to authenticate the user with remember me option
    if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    // Regenerate session to prevent session fixation
    $request->session()->regenerate();

    $user = Auth::user();
    if ($user->type === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->intended(route('home'));
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

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function processForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            // Since we're using sync queue driver in development, this will send the email immediately
            SendPasswordResetLinkJob::dispatch($request->email);

            // For debugging, let's also log that we attempted to send the reset link
            \Illuminate\Support\Facades\Log::info('Password reset link dispatched for: ' . $request->email);

            // Always return a success message to prevent email enumeration
            return back()->with(['status' => __('passwords.sent')]);
        } catch (\Exception $e) {
            // Log the error
            \Illuminate\Support\Facades\Log::error('Failed to send password reset link: ' . $e->getMessage());

            // Return a generic message to prevent email enumeration
            return back()->with(['status' => __('passwords.sent')]);
        }
    }

    public function resetPassword(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    public function processResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Reset the password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        // Return the status
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }


}
