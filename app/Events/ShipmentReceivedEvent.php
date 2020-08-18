<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShipmentReceivedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $described = 'A Shipment was marked as received';
    public $entityName;
    public $entityId;
    public $showRoute;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($shipment)
    {
        $shipment->load('fromAddress.addressable', 'toAddress.addressable');

        $this->entityName = sprintf('Shipment %s, from %s to %s',
                $shipment->id,
                $shipment->fromAddress->addressable->name ?? '?',
                $shipment->toAddress->addressable->name ?? '?'
        );

        $this->entityId = $shipment->id;
        $this->showRoute = route('shipment.show', $shipment);
    }

    public static function alertable()
    {
        return 'Shipment: When a Shipment has been marked as received';
    }
}
