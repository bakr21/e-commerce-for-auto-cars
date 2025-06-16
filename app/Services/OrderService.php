<?php

namespace App\Services;

use App\Events\OrderCreated;
use App\Events\OrderPlaced;
use App\Events\OrderStatusChanged;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderService
{
    /**
     * Create a new order.
     *
     * @param  Request  $request
     * @param  float  $subtotal
     * @param  float  $shipping
     * @param  float  $grandTotal
     * @param  string  $paymentStatus
     * @param  string  $status
     * @return Order
     */
    public function createOrder(Request $request, float $subtotal, float $shipping, float $grandTotal, string $paymentStatus = 'not paid', string $status = 'pending'): Order
    {
        // Get discount from session if available
        $discount = 0;
        $couponCode = null;

        if (session()->has('coupon')) {
            $coupon = session('coupon');
            $discount = session('coupon.discount', 0);
            $couponCode = $coupon['code'] ?? null;

            // Recalculate grand total with discount
            $grandTotal = ($subtotal + $shipping) - $discount;
        }

        $order = new Order();
        $order->user_id = Auth::id();
        $order->subtotal = $subtotal;
        $order->shipping = $shipping;
        $order->discount = $discount;
        $order->coupon_code = $couponCode;
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

        // Dispatch the OrderCreated event
        event(new OrderCreated($order));

        return $order;
    }

    /**
     * Save order items.
     *
     * @param  Order  $order
     * @param  \Illuminate\Database\Eloquent\Collection  $cartItems
     * @return void
     */
    public function saveOrderItems(Order $order, $cartItems): void
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
        }
    }

    /**
     * Update order status.
     *
     * @param  Order  $order
     * @param  string  $status
     * @param  string|null  $paymentStatus
     * @return Order
     */
    public function updateOrderStatus(Order $order, string $status, ?string $paymentStatus = null): Order
    {
        $oldStatus = $order->status;
        $oldPaymentStatus = $order->payment_status;

        // Update status
        if ($status !== $oldStatus) {
            $order->status = $status;

            // Dispatch the OrderStatusChanged event
            event(new OrderStatusChanged($order, $oldStatus, $status));
        }

        // Update payment status if provided
        if ($paymentStatus !== null && $paymentStatus !== $oldPaymentStatus) {
            $order->payment_status = $paymentStatus;
        }

        $order->save();

        return $order;
    }
}
