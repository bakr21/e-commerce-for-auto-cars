<?php

namespace App\Listeners;

use App\Events\PaymentFailed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyAdminOfPaymentFailure implements ShouldQueue
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
    public function handle(PaymentFailed $event): void
    {
        $order = $event->order;
        $paymentMethod = $event->paymentMethod;
        $errorMessage = $event->errorMessage;
        
        // Log the payment failure
        Log::error("Payment failed for order ID {$order->id} using {$paymentMethod}: {$errorMessage}");
        
        // In a real application, you would send an email to the admin
        // For now, we'll just log it
        Log::info("Admin notification would be sent for payment failure on order ID {$order->id}");
        
        // Example of how you might send an email to admin
        // Mail::to('admin@example.com')->send(new \App\Mail\PaymentFailureNotification($order, $paymentMethod, $errorMessage));
    }
}
