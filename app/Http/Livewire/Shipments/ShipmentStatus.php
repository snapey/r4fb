<?php

namespace App\Http\Livewire\Shipments;

use App\Shipment;
use Livewire\Component;

class ShipmentStatus extends Component
{
    public $shipment_id;

    public $cancelled;
    public $cancelled_state;
    public $received;
    public $received_state;

    public function mount($shipment)
    {
        $this->shipment_id = $shipment->id;

    }

    public function render()
    {
        $shipment = Shipment::findOrFail($this->shipment_id);

        $disabled = '';

        if ($shipment->updated_at->addMinutes(3) < now()) {
            dump('disabled');
            $disabled = 'disabled';
        }

        switch ($shipment->status) {
            case Shipment::PLANNED:
                $this->received = false;
                $this->received_state = '';
                $this->cancelled = false;
                $this->cancelled_state = '';
                break;
            case Shipment::RECEIVED:
                $this->received = true;
                $this->received_state = $disabled;
                $this->cancelled = false;
                $this->cancelled_state = $disabled;
                break;
            case Shipment::CANCELLED:
                $this->received = false;
                $this->received_state = $disabled;
                $this->cancelled = true;
                $this->cancelled_state = $disabled;
                break;
            default:
                # code...
                break;
        }
        return view('shipments.livewire.shipment-status')
            ->with('shipment', $shipment);
    }

    public function updatedReceived()
    {
        if($this->received) {
            Shipment::where('id',$this->shipment_id)->update(['status'=> Shipment::RECEIVED]);

        } else {
            Shipment::where('id', $this->shipment_id)->update(['status' => Shipment::PLANNED]);
        }
    }

    public function updatedCancelled()
    {
        if($this->cancelled) {
            Shipment::where('id',$this->shipment_id)->update(['status'=> Shipment::CANCELLED]);
        } else {
            Shipment::where('id', $this->shipment_id)->update(['status' => Shipment::PLANNED]);
        }
    }
}
