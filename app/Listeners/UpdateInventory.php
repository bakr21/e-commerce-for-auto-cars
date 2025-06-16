<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateInventory implements ShouldQueue
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
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        
        // Get all order items
        $orderItems = $order->items;
        
        foreach ($orderItems as $item) {
            $product = Product::find($item->product_id);
            
            if ($product) {
                // Decrease product quantity
                $product->qty -= $item->qty;
                $product->save();
                
                Log::info("Updated inventory for product ID {$product->id}. New quantity: {$product->qty}");
            } else {
                Log::warning("Product not found for order item ID {$item->id}");
            }
        }
    }
}
