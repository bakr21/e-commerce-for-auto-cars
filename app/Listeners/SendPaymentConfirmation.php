<?php

namespace App\Listeners;

use App\Events\PaymentProcessed;
use App\Jobs\SendOrderEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendPaymentConfirmation implements ShouldQueue
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
        
        // Dispatch email job
        SendOrderEmailJob::dispatch($order);
        
        Log::info("Payment confirmation email queued for order ID {$order->id}");
    }
}
