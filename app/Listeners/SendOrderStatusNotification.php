<?php

namespace App\Listeners;

use App\Events\OrderStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOrderStatusNotification implements ShouldQueue
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
    public function handle(OrderStatusChanged $event): void
    {
        $order = $event->order;
        $oldStatus = $event->oldStatus;
        $newStatus = $event->newStatus;
        
        Log::info("Order ID {$order->id} status changed from {$oldStatus} to {$newStatus}");
        
        // In a real application, you would send an email to the customer
        // For now, we'll just log it
        Log::info("Status change notification would be sent to {$order->email} for order ID {$order->id}");
        
        // Example of how you might send an email
        // Mail::to($order->email)->send(new \App\Mail\OrderStatusChanged($order, $oldStatus, $newStatus));
    }
}
