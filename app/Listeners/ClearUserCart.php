<?php

namespace App\Listeners;

use App\Events\PaymentProcessed;
use App\Models\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ClearUserCart implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentProcessed $event): void
    {
        $order = $event->order;
        $userId = $order->user_id;
        
        // Clear the user's cart
        $deletedCount = Cart::where('user_id', $userId)->delete();
        
        Log::info("Cleared {$deletedCount} cart items for user ID {$userId} after successful payment for order ID {$order->id}");
        
        // Clear any coupon session data
        if (session()->has('coupon')) {
            session()->forget('coupon');
            Log::info("Cleared coupon session data for user ID {$userId}");
        }
    }
}
