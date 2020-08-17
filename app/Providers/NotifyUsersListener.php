<?php

namespace App\Providers;

use App\Providers\FoodbankApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUsersListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FoodbankApproved  $event
     * @return void
     */
    public function handle(FoodbankApproved $event)
    {
        //
    }
}
