<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class PaymentFailed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Order
     */
    public $order;

    /**
     * The payment method that failed.
     *
     * @var string
     */
    public $paymentMethod;

    /**
     * The error message.
     *
     * @var string|null
     */
    public $errorMessage;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Order  $order
     * @param  string  $paymentMethod
     * @param  string|null  $errorMessage
     * @return void
     */
    public function __construct(Order $order, string $paymentMethod, ?string $errorMessage = null)
    {
        $this->order = $order;
        $this->paymentMethod = $paymentMethod;
        $this->errorMessage = $errorMessage;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
