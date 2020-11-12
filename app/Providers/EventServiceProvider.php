<?php

namespace App\Providers;

use App\Events\AllocationCompleteEvent;
use App\Events\BulkMailSent;
use App\Events\FoodbankAddedEvent;
use App\Events\FoodbankApprovedEvent;
use App\Events\SharedAllocationFinished;
use App\Events\ShipmentCancelledEvent;
use App\Events\ShipmentCreatedEvent;
use App\Events\ShipmentReceivedEvent;
use App\Listeners\NotifyUsersListener;
use App\Listeners\RecordSentBulkEmail;
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
        ],
        ShipmentCancelledEvent::class => [
            NotifyUsersListener::class
        ],
        ShipmentReceivedEvent::class => [
            NotifyUsersListener::class
        ],
        AllocationCompleteEvent::class => [
            NotifyUsersListener::class
        ],
        SharedAllocationFinished::class => [
            NotifyUsersListener::class
        ],
        BulkMailSent::class => [
            RecordSentBulkEmail::class
        ],
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
