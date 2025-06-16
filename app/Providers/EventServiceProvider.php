<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Events\OrderPlaced;
use App\Events\OrderStatusChanged;
use App\Events\PaymentFailed;
use App\Events\PaymentProcessed;
use App\Listeners\ClearUserCart;
use App\Listeners\NotifyAdminOfPaymentFailure;
use App\Listeners\SendOrderNotification;
use App\Listeners\SendOrderStatusNotification;
use App\Listeners\SendPaymentConfirmation;
use App\Listeners\UpdateInventory;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderPlaced::class => [
            SendOrderNotification::class,
        ],
        OrderCreated::class => [
            UpdateInventory::class,
        ],
        PaymentProcessed::class => [
            SendPaymentConfirmation::class,
            ClearUserCart::class,
        ],
        PaymentFailed::class => [
            NotifyAdminOfPaymentFailure::class,
        ],
        OrderStatusChanged::class => [
            SendOrderStatusNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
