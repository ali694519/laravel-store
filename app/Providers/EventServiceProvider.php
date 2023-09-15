<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Listeners\EmptyCart;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\DeductProductQuantity;
use App\Listeners\SendOrderCreatedNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        // 'order.created'=>[
        //     DeductProductQuantity::class,
        //     EmptyCart::class,
        // ],
        OrderCreated::class=>[
        DeductProductQuantity::class,
        SendOrderCreatedNotification::class,
        EmptyCart::class,
        ]
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
