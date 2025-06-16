<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderEmail;
use App\Exceptions\MailException;
use Illuminate\Support\Facades\Log;

class SendOrderEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        try {
            $mailData = [
                'subject' => 'Your Order Invoice',
                'order' => $this->order,
                'userType' => 'customer'
            ];

            Mail::to($this->order->email)->send(new OrderEmail($mailData));

            Log::info('Order email sent successfully', [
                'order_id' => $this->order->id,
                'email' => $this->order->email
            ]);

        } catch (\Exception $e) {
            MailException::handleMailError($e, [
                'order_id' => $this->order->id,
                'email' => $this->order->email,
                'job' => 'SendOrderEmailJob'
            ]);

            // Don't fail the job, just log the error
            // This prevents the order process from failing due to email issues
        }
    }
}
