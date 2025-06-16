<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\ProcessCheckoutRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    protected $cartService;
    protected $orderService;
    protected $paymentService;

    /**
     * Create a new controller instance.
     *
     * @param CartService $cartService
     * @param OrderService $orderService
     * @param PaymentService $paymentService
     */
    public function __construct(CartService $cartService, OrderService $orderService, PaymentService $paymentService)
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->paymentService = $paymentService;
    }
    /**
     * Display the checkout page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get cart items
        $carts = $this->cartService->getCartItems();

        // Calculate subtotal
        $subTotal = $this->cartService->calculateSubtotal($carts);

        // Get countries for dropdown
        $countries = Country::orderBy('name', 'ASC')->get();

        // Get customer address
        $customerAddress = CustomerAddress::where('user_id', Auth::user()->id)->first();

        // Calculate discount
        $discount = $this->cartService->calculateDiscount($subTotal);

        // Initialize shipping charge
        $totalShippingCharge = 0;
        $grandTotal = $subTotal - $discount;

        // Calculate shipping if customer address exists
        if ($customerAddress) {
            $userCountry = $customerAddress->country_id;
            $totalQty = $carts->sum('qty');
            $totalShippingCharge = $this->cartService->calculateShipping($userCountry, $totalQty);
            $grandTotal += $totalShippingCharge;
        }

        return view('website.checkout.index', compact(
            'carts',
            'subTotal',
            'countries',
            'customerAddress',
            'totalShippingCharge',
            'grandTotal',
            'discount'
        ));
    }

    /**
     * Process the checkout request.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function processCheckout(ProcessCheckoutRequest $request)
    {
        // Check if cart is empty
        $cartItems = $this->cartService->getCartItems();
        if ($cartItems->isEmpty()) {
            return response()->json([
                'message' => 'Your cart is empty. Add products to proceed with checkout.',
                'status' => false,
            ]);
        }

        // Save user address
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
        $subtotal = $this->cartService->calculateSubtotal($cartItems);
        $totalQty = $cartItems->sum('qty');
        $shipping = $this->cartService->calculateShipping($request->country, $totalQty);
        $discount = $this->cartService->calculateDiscount($subtotal);
        $grandTotal = ($subtotal + $shipping) - $discount;

        // Log the payment method for debugging
        Log::info('Checkout - Payment Method: ' . $request->payment_method);

        // Process based on payment method
        switch ($request->payment_method) {
            case 'cod':
                Log::info('Checkout - Processing COD payment');
                return response()->json(
                    $this->paymentService->processCOD($request, $cartItems, $subtotal, $shipping, $grandTotal)
                );

            case 'card':
                Log::info('Checkout - Processing PayPal payment');
                return response()->json(
                    $this->paymentService->processPayPal($request, $cartItems, $subtotal, $shipping, $grandTotal)
                );

            case 'stripe':
                Log::info('Checkout - Processing Stripe payment');
                return response()->json(
                    $this->paymentService->processStripe($cartItems, $subtotal, $shipping, $grandTotal)
                );

            default:
                Log::error('Checkout - Invalid payment method: ' . $request->payment_method);
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid payment method selected.',
                ]);
        }
    }




    /**
     * Handle successful PayPal payment.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function paypalSuccess(Request $request)
    {
        $orderId = $request->order_id;

        // Check if we have the required parameters
        if (!$orderId) {
            return redirect()->route('checkout.index')->with('error', 'Missing order ID parameter.');
        }

        // Process the successful payment
        $order = $this->paymentService->handlePayPalSuccess($orderId);

        if (!$order) {
            return redirect()->route('checkout.index')->with('error', 'Order not found.');
        }

        return redirect()->route('checkout.thankyou', ['orderId' => $order->id]);
    }

    /**
     * Handle successful Stripe payment.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function stripeSucces(Request $request)
    {
        $sessionId = $request->session_id;

        if (!$sessionId) {
            return redirect()->route('checkout.index')->with('error', 'Invalid payment session.');
        }

        // Process the successful payment
        $order = $this->paymentService->handleStripeSuccess($sessionId);

        if (!$order) {
            return redirect()->route('checkout.index')->with('error', 'Payment not completed or order not found.');
        }

        // Clear session data
        session()->forget(['stripe_order_id']);

        return redirect()->route('checkout.thankyou', ['orderId' => $order->id]);
    }

    /**
     * Handle Stripe payment cancellation.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function stripeCancel()
    {
        // Clear any Stripe session data
        session()->forget('stripe_order_id');

        return redirect()->route('checkout.index')->withErrors('Payment was cancelled.');
    }

    /**
     * Handle PayPal payment cancellation.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function paypalCancel(Request $request)
    {
        // Get the order ID if available
        $orderId = $request->order_id;

        if ($orderId) {
            // Find the order
            $order = Order::find($orderId);

            if ($order) {
                // Update order status to cancelled
                $this->orderService->updateOrderStatus($order, 'cancelled');
            }
        }

        // Clear any PayPal session data
        session()->forget('paypal_order_id');

        return redirect()->route('checkout.index')->with('error', 'Payment was cancelled. Please try again or choose a different payment method.');
    }

    /**
     * Get order summary with pricing details.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrderSummary(Request $request)
    {
        $summary = $this->cartService->getOrderSummary($request);
        return response()->json($summary);
    }

    /**
     * Apply discount coupon.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function applyDiscount(Request $request)
    {
        // Validate request
        if (!$request->coupon_code) {
            return response()->json([
                'status' => false,
                'message' => 'Coupon code is required.'
            ]);
        }

        // Apply the discount
        $result = $this->cartService->applyDiscount($request->coupon_code);

        if (!$result['status']) {
            return response()->json($result);
        }

        // Return updated order summary
        return $this->getOrderSummary($request);
    }

    /**
     * Remove discount coupon.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeDiscount(Request $request)
    {
        $this->cartService->removeDiscount();
        return $this->getOrderSummary($request);
    }

    /**
     * Display thank you page after successful order.
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function thankYou($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->route('checkout.index')->with('error', 'Order not found.');
        }

        return view('website.checkout.thanks', compact('id', 'order'));
    }

}
