<?php

namespace App\Events;

use App\Allocation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SharedAllocationFinished
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $described = 'A shared allocation was marked as finished';
    public $entityName;
    public $entityId;
    public $showRoute;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($allocation_id)
    {
        $allocation = Allocation::with('foodbank')->find($allocation_id);

        $this->entityName = sprintf(
            'Allocation %s, for %s',
            $allocation->id,
            $allocation->foodbank->name ?? '?',
        );

        $this->entityId = $allocation->id;
        $this->showRoute = route('allocations.show', $allocation);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public static function alertable()
    {
        return 'Allocation: When an Allocation that was shared has been marked as finished';
    }

}
