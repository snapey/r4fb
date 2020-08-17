<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FoodbankAddedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $described = 'A new Food Bank was added to R4FB';
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
        return 'When new Foodbank Added';
    }
}
