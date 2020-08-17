<?php

namespace App\Providers;

use App\Events\FoodbankAddedEvent;
use App\Events\FoodbankApprovedEvent;
use App\Events\ShipmentCreatedEvent;
use App\Listeners\NotifyUsersListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        FoodbankAddedEvent::class => [
            NotifyUsersListener::class,
        ],
        FoodbankApprovedEvent::class => [
            NotifyUsersListener::class
        ],
        ShipmentCreatedEvent::class => [
            NotifyUsersListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
