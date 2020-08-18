<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FoodbankApprovedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $described = 'A Food Bank was changed to \'Approved\' state';
    public $entityName;
    public $entityId;
    public $showRoute;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($foodbank)
    {
        $this->entityName = $foodbank->name;
        $this->entityId = $foodbank->id;
        $this->showRoute = route('admin.foodbanks.show',$foodbank);
    }

    public static function alertable()
    {
        return 'Foodbank: When Foodbank status changed to Approved';
    }
}
