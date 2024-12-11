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
use Illuminate\Support\Facades\Log;



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

    public function processCheckout(Request $request)
    {
        // Check if cart is empty
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        if ($cartItems->isEmpty()) {
            return response()->json([
                'message' => 'Your cart is empty. Add products to proceed with checkout.',
                'status' => false,
            ]);
        }

        // Step 1: Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required',
            'address' => 'required|min:15',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please fix the errors.',
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        // Step 2: Save user address
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

        // Calculate totals
        $subtotal = $cartItems->reduce(fn($carry, $item) => $carry + ($item->product->selling_price * $item->qty), 0);
        $totalQty = $cartItems->sum('qty');
        $shippingInfo = ShippingCharges::where('country_id', $request->country)->first();
        $shipping = $shippingInfo ? $totalQty * $shippingInfo->amount : $totalQty * 50;
        $grandTotal = $subtotal + $shipping;

        if ($request->payment_method === 'cod') {
            return $this->processCOD($request, $cartItems, $subtotal, $shipping, $grandTotal);
        } elseif ($request->payment_method === 'card') {
            return $this->processPayPal($request, $cartItems, $subtotal, $shipping, $grandTotal);
        } else {
            return $this->processStripe($cartItems);
        }
    }

    private function processCOD($request, $cartItems, $subtotal, $shipping, $grandTotal)
    {
        $order = $this->createOrder($request, $subtotal, $shipping, $grandTotal, 'not paid', 'pending');
        $this->saveOrderItems($order, $cartItems);

        Cart::where('user_id', Auth::id())->delete();

        return response()->json([
            'message' => 'Order saved successfully',
            'status' => true,
            'orderId' => $order->id,
            'payment_method' => 'cod',
        ]);
    }

    private function processPayPal($request, $cartItems, $subtotal, $shipping, $grandTotal)
    {
        $order = $this->createOrder($request, $subtotal, $shipping, $grandTotal, 'not paid', 'pending');

        $provider = new \Srmklive\PayPal\Services\PayPal;
        $provider->setApiCredentials(config('paypal'));

        $orderData = [
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "reference_id" => "ORDER-" . $order->id,
                    "amount" => [
                        "currency_code" => config('paypal.currency'),
                        "value" => number_format($grandTotal, 2, '.', ''),
                    ],
                    "description" => "Payment for Order #" . $order->id,
                ]
            ],
            "application_context" => [
                "brand_name" => "Your Brand Name",
                "cancel_url" => route('paypal.cancel'),
                "return_url" => route('paypal.success', ['order_id' => $order->id]),
                "landing_page" => "BILLING",
                "user_action" => "PAY_NOW",
            ]
        ];

        $response = $provider->createOrder($orderData);

        if (isset($response['status']) && $response['status'] === 'CREATED') {
            $redirectUrl = collect($response['links'])->firstWhere('rel', 'approve')['href'];

            return response()->json([
                'status' => true,
                'redirect_url' => $redirectUrl,
                'payment_method' => 'card',
                'message' => 'Please complete the payment through PayPal.',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to create PayPal order.',
            'details' => $response,
        ]);
    }

    private function processStripe($cartItems)
    {
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
        $lineItems = $cartItems->map(fn($item) => [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => ['name' => $item->product->name],
                'unit_amount' => $item->product->selling_price * 100,
            ],
            'quantity' => $item->qty,
        ])->toArray();

        $response = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
        ]);

        if (isset($response->id)) {
            return response()->json([
                'status' => true,
                'redirect_url' => $response->url,
                'payment_method' => 'stripe',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to create Stripe session.',
        ]);
    }

    private function createOrder($request, $subtotal, $shipping, $grandTotal, $paymentStatus, $status)
    {
        $order = new Order();
        $order->user_id = Auth::id();
        $order->subtotal = $subtotal;
        $order->shipping = $shipping;
        $order->discount = 0;
        $order->grand_total = $grandTotal;
        $order->payment_status = $paymentStatus;
        $order->status = $status;
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

        return $order;
    }

    private function saveOrderItems($order, $cartItems)
    {
        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->name = $item->product->name;
            $orderItem->qty = $item->qty;
            $orderItem->price = $item->product->selling_price;
            $orderItem->total = $item->qty * $item->product->selling_price;
            $orderItem->save();

            $product = Product::find($item->product_id);
            if ($product) {
                $product->qty -= $item->qty;
                $product->save();
            }
        }
    }


    public function paypalSuccess(Request $request)
    {
        $orderId = $request->order_id; // معرف الطلب المحلي
        $paypalToken = $request->token; // رمز الطلب من PayPal
        $payerId = $request->PayerID; // معرف المستخدم من PayPal

        if (!$orderId || !$paypalToken || !$payerId) {
            return response()->json([
                'status' => false,
                'message' => 'Missing required parameters.'
            ]);
        }

        // تحميل الطلب من قاعدة البيانات
        $order = Order::find($orderId);
        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Order not found.'
            ]);
        }

        // التحقق من الطلب من خلال PayPal
        $provider = new \Srmklive\PayPal\Services\PayPal;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        try {
            $response = $provider->capturePaymentOrder($paypalToken);

            if (isset($response['status']) && $response['status'] === 'COMPLETED') {
                // تحديث حالة الطلب عند النجاح
                $order->payment_status = 'paid';
                $order->status = 'completed';
                $order->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Payment successful!',
                    'order_id' => $order->id
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Payment not completed.',
                    'details' => $response
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to capture payment.',
                'error' => $e->getMessage()
            ]);
        }
    }
    
    public function stripeSucces(Request $request)
    {
        if (isset($request->session_id)) {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);

            if ($response && $response->payment_status === 'paid') {
                $userId = Auth::id();

                // Fetch cart items
                $cartItems = Cart::where('user_id', $userId)->with('product')->get();

                if ($cartItems->isEmpty()) {
                    return redirect()->route('checkout.index')->with('error', 'Cart is empty.');
                }

                // Create a new order
                $subtotal = $cartItems->reduce(function ($carry, $item) {
                    return $carry + ($item->product->selling_price * $item->qty);
                }, 0);

                $shipping = 0; // Calculate shipping if needed
                $grandTotal = $subtotal + $shipping;

                $order = new Order();
                $order->user_id = $userId;
                $order->subtotal = $subtotal;
                $order->shipping = $shipping;
                $order->grand_total = $grandTotal;
                $order->payment_status = 'paid';
                
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

                // Save order items
                foreach ($cartItems as $item) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $item->product_id;
                    $orderItem->name = $item->product->name;
                    $orderItem->qty = $item->qty;
                    $orderItem->price = $item->product->selling_price;
                    $orderItem->total = $item->qty * $item->product->selling_price;
                    $orderItem->save();

                    // Decrease product quantity
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->qty -= $item->qty;
                        $product->save();
                    }
                }

                // Clear the cart
                Cart::where('user_id', $userId)->delete();

                return redirect()->route('thank.you', ['id' => $order->id]);
            }
        }

        return redirect()->route('stripe.cancel');
    }


    public function stripeCancel()
    {
        return "Cancel payment";
    }
    public function paypalCancel()
    {
        return redirect()->route('checkout.index')->withErrors('Payment was cancelled.');
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
        
        if (!$order) {
            return redirect()->route('checkout.index')->with('error', 'Order not found.');
        }
        
        return view('website.checkout.thanks', compact('id', 'order'));
    }
    
}
