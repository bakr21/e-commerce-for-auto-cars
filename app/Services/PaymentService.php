<?php

namespace App\Services;

use App\Events\OrderPlaced;
use App\Events\PaymentFailed;
use App\Events\PaymentProcessed;
use App\Models\CustomerAddress;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    protected $orderService;

    /**
     * Create a new service instance.
     *
     * @param  OrderService  $orderService
     * @return void
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Process COD payment.
     *
     * @param  Request  $request
     * @param  \Illuminate\Database\Eloquent\Collection  $cartItems
     * @param  float  $subtotal
     * @param  float  $shipping
     * @param  float  $grandTotal
     * @return array
     */
    public function processCOD(Request $request, $cartItems, float $subtotal, float $shipping, float $grandTotal): array
    {
        // Create order
        $order = $this->orderService->createOrder($request, $subtotal, $shipping, $grandTotal, 'not paid', 'pending');

        // Save order items
        $this->orderService->saveOrderItems($order, $cartItems);

        // Dispatch payment processed event
        event(new PaymentProcessed($order, 'cod'));

        // Dispatch order placed event
        event(new OrderPlaced($order));

        return [
            'message' => 'Order saved successfully',
            'status' => true,
            'title' => __('checkout.order_placed'),
            'text' => __('checkout.order_placed_message'),
            'orderId' => $order->id,
            'payment_method' => 'cod',
        ];
    }

    /**
     * Process PayPal payment.
     *
     * @param  Request  $request
     * @param  \Illuminate\Database\Eloquent\Collection  $cartItems
     * @param  float  $subtotal
     * @param  float  $shipping
     * @param  float  $grandTotal
     * @return array
     */
    public function processPayPal(Request $request, $cartItems, float $subtotal, float $shipping, float $grandTotal): array
    {
        // Create order
        $order = $this->orderService->createOrder($request, $subtotal, $shipping, $grandTotal, 'not paid', 'pending');

        // Save order items
        $this->orderService->saveOrderItems($order, $cartItems);

        try {
            // Initialize the PayPal provider with direct configuration
            $provider = new \Srmklive\PayPal\Services\PayPal;

            // Create a direct configuration array
            $config = [
                'mode' => 'sandbox',
                'sandbox' => [
                    'client_id' => 'AR9IxLkiIqSvXHypXfQgUrM1jLVdunt_UXXwDoA5-4gb-k9KXn1UYPms1M-HspX_P-NKZK3dOUJUpR-w',
                    'client_secret' => 'ENv6b15NvI5MasMtmLjcd3z3sJHQ73ixEpDhK5AT-P8X9lJEu_00DpPIZrF0y8wdp6rH_l7RoaTcV-Hd',
                    'app_id' => 'APP-80W284485P519543T',
                ],
                'payment_action' => 'Sale',
                'currency' => 'USD',
                'notify_url' => '',
                'locale' => 'en_US',
                'validate_ssl' => true,
            ];

            // Set the API credentials
            $provider->setApiCredentials($config);

            // Get access token (required for authentication)
            $provider->getAccessToken();

            // Convert EGP to USD (approximate conversion rate, should be updated regularly)
            // As of now, 1 USD ≈ 50 EGP (this is an approximation)
            $conversionRate = 50.0;
            $amountInUSD = $grandTotal / $conversionRate;

            // Format the amount properly - ensure it's a valid number format for PayPal
            $formattedAmount = number_format($amountInUSD, 2, '.', '');

            // Create the order data with simplified structure
            $orderData = [
                "intent" => "CAPTURE",
                "purchase_units" => [
                    [
                        "reference_id" => "ORDER-" . $order->id,
                        "amount" => [
                            "currency_code" => "USD", // Use USD directly
                            "value" => $formattedAmount,
                        ],
                        "description" => "Payment for Order #" . $order->id,
                    ]
                ],
                "application_context" => [
                    "brand_name" => "PartsCars",
                    "cancel_url" => route('paypal.cancel', ['order_id' => $order->id]),
                    "return_url" => route('paypal.success', ['order_id' => $order->id]),
                    "landing_page" => "BILLING",
                    "user_action" => "PAY_NOW",
                    "shipping_preference" => "NO_SHIPPING",
                ]
            ];

            // Create the PayPal order
            $response = $provider->createOrder($orderData);

            if (isset($response['status']) && $response['status'] === 'CREATED') {
                // Find the approval URL
                $approvalLink = null;
                if (isset($response['links'])) {
                    foreach ($response['links'] as $link) {
                        if ($link['rel'] === 'approve') {
                            $approvalLink = $link['href'];
                            break;
                        }
                    }
                }

                if (!$approvalLink) {
                    Log::error('PayPal Error: No approval URL found in response');

                    // Dispatch payment failed event
                    event(new PaymentFailed($order, 'paypal', 'No approval URL found in response'));

                    return [
                        'status' => false,
                        'message' => 'Failed to create PayPal payment link.',
                        'details' => $response,
                    ];
                }

                // Store the PayPal order ID in the session for verification later
                session()->put('paypal_order_id', $response['id']);

                return [
                    'status' => true,
                    'redirect_url' => $approvalLink,
                    'payment_method' => 'card',
                    'message' => 'Please complete the payment through PayPal. Amount: $' . $formattedAmount . ' USD',
                    'amount_usd' => $formattedAmount,
                ];
            }

            // If we get here, something went wrong with the PayPal order creation
            Log::error('PayPal Error: Failed to create order');

            // Dispatch payment failed event
            event(new PaymentFailed($order, 'paypal', 'Failed to create PayPal order'));

            return [
                'status' => false,
                'message' => 'Failed to create PayPal order.',
                'details' => $response,
            ];

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('PayPal Error: ' . $e->getMessage());

            // Dispatch payment failed event
            event(new PaymentFailed($order, 'paypal', $e->getMessage()));

            return [
                'status' => false,
                'message' => 'PayPal error: ' . $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Process Stripe payment.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $cartItems
     * @param  float  $subTotal
     * @param  float  $shipping
     * @param  float  $grandTotal
     * @return array
     */
    public function processStripe($cartItems, float $subTotal, float $shipping, float $grandTotal): array
    {
        // Stripe API setup
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

        // Get user address
        $customerAddress = CustomerAddress::where('user_id', Auth::user()->id)->first();

        if (!$customerAddress) {
            return [
                'status' => false,
                'message' => 'User address not found.',
            ];
        }

        // Create order in database
        $request = request(); // Get the current request
        $order = $this->orderService->createOrder($request, $subTotal, $shipping, $grandTotal, 'not paid', 'pending');

        // Save order items
        $this->orderService->saveOrderItems($order, $cartItems);

        // Store the order ID in the session for verification later
        session()->put('stripe_order_id', $order->id);

        // Set up product details
        $lineItems = $cartItems->map(fn($item) => [
            'price_data' => [
                'currency' => 'egp',
                'product_data' => ['name' => $item->product->name],
                'unit_amount' => ($item->product->selling_price) * 100,
            ],
            'quantity' => $item->qty,
        ])->toArray();

        // Add shipping charges to the total
        $lineItems[] = [
            'price_data' => [
                'currency' => 'egp',
                'product_data' => ['name' => 'Shipping Charges'],
                'unit_amount' => $shipping * 100,
            ],
            'quantity' => 1,
        ];

        // Calculate discount from session
        $discount = 0;
        if (session()->has('coupon')) {
            $coupon = session('coupon');
            $discount = session('coupon.discount', 0);
        }

        // Instead of adding a negative line item for discount (which Stripe doesn't support),
        // we'll create a new array of line items with adjusted prices
        if ($discount > 0) {
            // Create a new array for adjusted line items
            $adjustedLineItems = [];

            // Get only product items (exclude shipping)
            $productItems = array_slice($lineItems, 0, count($lineItems) - 1);
            $shippingItem = end($lineItems);

            // Calculate total product amount in cents
            $totalProductAmount = 0;
            foreach ($productItems as $item) {
                $totalProductAmount += ($item['price_data']['unit_amount'] * $item['quantity']);
            }

            // Calculate discount per cent
            $discountInCents = round($discount * 100);

            // If we have products
            if (count($productItems) > 0 && $totalProductAmount > 0) {
                // Apply discount proportionally to each product
                $remainingDiscount = $discountInCents;

                for ($i = 0; $i < count($productItems) - 1; $i++) {
                    $item = $productItems[$i];
                    $itemTotal = $item['price_data']['unit_amount'] * $item['quantity'];
                    $itemDiscountShare = round(($itemTotal / $totalProductAmount) * $discountInCents);

                    // Don't apply more discount than we have left
                    $itemDiscountShare = min($itemDiscountShare, $remainingDiscount);
                    $remainingDiscount -= $itemDiscountShare;

                    // Calculate new unit price
                    $newUnitAmount = max(1, round(($itemTotal - $itemDiscountShare) / $item['quantity']));

                    // Create adjusted item
                    $adjustedItem = $item;
                    $adjustedItem['price_data']['unit_amount'] = $newUnitAmount;
                    $adjustedLineItems[] = $adjustedItem;
                }

                // Apply remaining discount to the last product
                if (count($productItems) > 0) {
                    $lastItem = $productItems[count($productItems) - 1];
                    $itemTotal = $lastItem['price_data']['unit_amount'] * $lastItem['quantity'];

                    // Ensure we don't make the price negative
                    $newTotal = max(1, $itemTotal - $remainingDiscount);
                    $newUnitAmount = max(1, round($newTotal / $lastItem['quantity']));

                    // Create adjusted item
                    $adjustedItem = $lastItem;
                    $adjustedItem['price_data']['unit_amount'] = $newUnitAmount;
                    $adjustedLineItems[] = $adjustedItem;
                }
            } else {
                // If no products, just keep the original items
                $adjustedLineItems = $productItems;
            }

            // Add shipping item back
            $adjustedLineItems[] = $shippingItem;

            // Add a note item about the discount
            $adjustedLineItems[] = [
                'price_data' => [
                    'currency' => 'egp',
                    'product_data' => [
                        'name' => 'Discount Applied: ' . ($coupon['code'] ?? 'Coupon') . ' (-' . round($discount, 2) . ' EGP)'
                    ],
                    'unit_amount' => 1, // Minimal amount required by Stripe
                ],
                'quantity' => 1,
            ];

            // Replace original line items with adjusted ones
            $lineItems = $adjustedLineItems;
        }

        try {
            // Calculate the total amount from line items to verify it matches grandTotal
            $calculatedTotal = 0;
            foreach ($lineItems as $item) {
                $calculatedTotal += ($item['price_data']['unit_amount'] * $item['quantity']);
            }
            $calculatedTotal = $calculatedTotal / 100; // Convert from cents to EGP

            // Log the amounts for debugging
            Log::info('Stripe Payment - Grand Total: ' . $grandTotal . ' EGP, Calculated Total: ' . $calculatedTotal . ' EGP');

            // If there's a significant difference between calculated and expected total
            if (abs($calculatedTotal - $grandTotal) > 1) {
                Log::warning('Stripe Payment - Total mismatch! Expected: ' . $grandTotal . ' EGP, Calculated: ' . $calculatedTotal . ' EGP');

                // Adjust the last item to match the expected total if needed
                $difference = $grandTotal - $calculatedTotal;
                $differenceInCents = round($difference * 100);

                if (count($lineItems) > 0) {
                    $lastItem = &$lineItems[count($lineItems) - 2]; // Get the item before the discount note
                    $lastItem['price_data']['unit_amount'] += $differenceInCents;

                    // Recalculate total
                    $calculatedTotal = 0;
                    foreach ($lineItems as $item) {
                        $calculatedTotal += ($item['price_data']['unit_amount'] * $item['quantity']);
                    }
                    $calculatedTotal = $calculatedTotal / 100;

                    Log::info('Stripe Payment - Adjusted Total: ' . $calculatedTotal . ' EGP');
                }
            }

            // Set up Stripe checkout session
            $response = $stripe->checkout->sessions->create([
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel'),
            ]);

            // Check if Stripe session exists
            if (isset($response->id)) {
                return [
                    'status' => true,
                    'redirect_url' => $response->url,
                    'payment_method' => 'stripe',
                ];
            }

            // If Stripe request fails
            event(new PaymentFailed($order, 'stripe', 'Failed to create Stripe session'));

            return [
                'status' => false,
                'message' => 'Failed to create Stripe session.',
            ];
        } catch (\Exception $e) {
            Log::error('Stripe Error: ' . $e->getMessage());

            // Dispatch payment failed event
            event(new PaymentFailed($order, 'stripe', $e->getMessage()));

            return [
                'status' => false,
                'message' => 'Stripe error: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Handle successful PayPal payment.
     *
     * @param  int  $orderId
     * @return Order|null
     */
    public function handlePayPalSuccess(int $orderId): ?Order
    {
        $order = Order::find($orderId);

        if (!$order) {
            return null;
        }

        // Update order status
        $this->orderService->updateOrderStatus($order, 'pending', 'paid');

        // Dispatch payment processed event
        event(new PaymentProcessed($order, 'paypal'));

        // Dispatch order placed event
        event(new OrderPlaced($order));

        return $order;
    }

    /**
     * Handle successful Stripe payment.
     *
     * @param  string  $sessionId
     * @return Order|null
     */
    public function handleStripeSuccess(string $sessionId): ?Order
    {
        try {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($sessionId);

            if (!$response || $response->payment_status !== 'paid') {
                return null;
            }

            $user = Auth::user();

            // Check if we have an order ID in the session
            $orderId = session()->get('stripe_order_id');

            if ($orderId) {
                $order = Order::find($orderId);
            } else {
                // Fallback: Find the most recent pending order for this user
                $order = Order::where('user_id', $user->id)
                              ->where('payment_status', 'not paid')
                              ->orderBy('created_at', 'desc')
                              ->first();
            }

            if (!$order) {
                return null;
            }

            // Update order payment status
            $this->orderService->updateOrderStatus($order, 'pending', 'paid');

            // Dispatch payment processed event
            event(new PaymentProcessed($order, 'stripe'));

            // Dispatch order placed event
            event(new OrderPlaced($order));

            return $order;

        } catch (\Exception $e) {
            Log::error('Stripe Success Error: ' . $e->getMessage());
            return null;
        }
    }
}
