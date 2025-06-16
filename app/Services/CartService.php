<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\DiscountCoupon;
use App\Models\ShippingCharges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartService
{
    /**
     * Get cart items for the current user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCartItems()
    {
        return Cart::where('user_id', Auth::id())->with('product')->get();
    }

    /**
     * Calculate subtotal from cart items.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $cartItems
     * @return float
     */
    public function calculateSubtotal($cartItems): float
    {
        return $cartItems->sum(function($item) {
            return $item->product->selling_price * $item->qty;
        });
    }

    /**
     * Calculate shipping charges.
     *
     * @param  int  $countryId
     * @param  int  $totalQty
     * @return float
     */
    public function calculateShipping(int $countryId, int $totalQty): float
    {
        if ($countryId > 0) {
            $shippingInfo = ShippingCharges::where('country_id', $countryId)->first();
            return $shippingInfo ? $totalQty * $shippingInfo->amount : $totalQty * 50;
        }
        
        return 0;
    }

    /**
     * Calculate discount from coupon.
     *
     * @param  float  $subtotal
     * @return float
     */
    public function calculateDiscount(float $subtotal): float
    {
        $discount = 0;
        
        if (session()->has('coupon')) {
            $coupon = session('coupon');
            $discount = session('coupon.discount', 0);
            
            // Recalculate discount if not already calculated
            if ($discount == 0 && isset($coupon['discount_type'], $coupon['discount_amount'])) {
                if ($coupon['discount_type'] === 'percentage') {
                    $discount = $subtotal * ($coupon['discount_amount'] / 100);
                } else {
                    $discount = min($coupon['discount_amount'], $subtotal);
                }
                $discount = round($discount, 2);
                
                // Store the calculated discount in the session
                session()->put('coupon.discount', $discount);
            }
        }
        
        return $discount;
    }

    /**
     * Apply discount coupon.
     *
     * @param  string  $couponCode
     * @return array
     */
    public function applyDiscount(string $couponCode): array
    {
        // Validate coupon code
        if (empty($couponCode)) {
            return [
                'status' => false,
                'message' => 'Coupon code is required.'
            ];
        }
        
        // Find coupon by code
        $coupon = DiscountCoupon::where('code', $couponCode)
                               ->where('is_active', 1)
                               ->first();
        
        // Check if coupon exists and is not expired
        if (!$coupon) {
            return [
                'status' => false,
                'message' => 'Coupon is invalid or not found.'
            ];
        }
        
        // Check if coupon is expired
        if ($coupon->end_date && now()->greaterThan($coupon->end_date)) {
            return [
                'status' => false,
                'message' => 'Coupon has expired.'
            ];
        }
        
        // Check if coupon is not yet active
        if ($coupon->start_date && now()->lessThan($coupon->start_date)) {
            return [
                'status' => false,
                'message' => 'Coupon is not yet active.'
            ];
        }
        
        // Get cart total to check minimum order amount
        $cartItems = $this->getCartItems();
        $subtotal = $this->calculateSubtotal($cartItems);
        
        // Check minimum order amount
        if ($coupon->min_order_amount > 0 && $subtotal < $coupon->min_order_amount) {
            return [
                'status' => false,
                'message' => 'Minimum order amount of ' . $coupon->min_order_amount . ' is required to use this coupon.'
            ];
        }
        
        // Store coupon in session
        session()->put('coupon', [
            'code' => $coupon->code,
            'name' => $coupon->name,
            'discount_amount' => $coupon->discount_amount,
            'discount_type' => $coupon->discount_type,
            'min_order_amount' => $coupon->min_order_amount
        ]);
        
        return [
            'status' => true,
            'message' => 'Coupon applied successfully.'
        ];
    }

    /**
     * Remove discount coupon.
     *
     * @return void
     */
    public function removeDiscount(): void
    {
        session()->forget('coupon');
    }

    /**
     * Clear user's cart.
     *
     * @param  int  $userId
     * @return int
     */
    public function clearCart(int $userId): int
    {
        return Cart::where('user_id', $userId)->delete();
    }

    /**
     * Get order summary.
     *
     * @param  Request  $request
     * @return array
     */
    public function getOrderSummary(Request $request): array
    {
        $cartItems = $this->getCartItems();
        $subtotal = $this->calculateSubtotal($cartItems);
        $totalQty = $cartItems->sum('qty');
        
        // Calculate shipping
        $shippingCharge = 0;
        if ($request->country_id > 0) {
            $shippingCharge = $this->calculateShipping($request->country_id, $totalQty);
        }
        
        // Calculate discount
        $discount = $this->calculateDiscount($subtotal);
        $discountDetails = null;
        
        if (session()->has('coupon')) {
            $coupon = session('coupon');
            $discountDetails = [
                'code' => $coupon['code'],
                'name' => $coupon['name'] ?? $coupon['code'],
                'amount' => $discount,
                'type' => $coupon['discount_type']
            ];
        }
        
        $grandTotal = ($subtotal + $shippingCharge) - $discount;
        
        return [
            'status' => true,
            'subTotal' => $subtotal,
            'shippingCharge' => $shippingCharge,
            'discount' => $discount,
            'discountDetails' => $discountDetails,
            'grandTotal' => round($grandTotal, 2),
        ];
    }
}
