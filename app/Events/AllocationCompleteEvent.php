<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AllocationCompleteEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $described = 'An Allocation of food to a Foodbank was marked as complete';
    public $entityName;
    public $entityId;
    public $showRoute;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($allocation)
    {
        $allocation->load('foodbank');

        $this->entityName = $allocation->foodbank->name;

        $this->entityId = $allocation->id;
        $this->showRoute = route('allocations.show', $allocation);

    }

    public static function alertable()
    {
        return 'Allocation: When an Allocation has been marked as complete';
    }
}
