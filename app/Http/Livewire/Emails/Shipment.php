<?php

namespace App\Http\Livewire\Emails;

use App\Providers\BulkMailProvider;
use App\Template;
use Livewire\Component;

class Shipment extends Component
{
    public $shipment;
    public $templates;
    public $template_id;
    public $subject;
    public $body;
    public $purpose;
    public $recipients =[];
    public $rcount;

    public function mount($shipment)
    {
        $this->shipment = $shipment;
        $this->templates = Template::where('context','shipment')->get(['id','title']);
    }

    public $listeners = ['bodyUpdate'];

    public function render()
    {
        $this->shipment->load(
                'fromAddress.addressable.contacts',
                'toAddress.addressable.contacts',
                'allocations.foodbank.contacts',
                'allocations.foodbank.clubs.contacts'
            );
        
        $this->rcount = collect($this->recipients)->filter()->count();

        return view('shipments.livewire.emails');
    }

    public function updatedTemplateId()
    {   
        $template = Template::findOrNew($this->template_id);
        
        $template->setShipment($this->shipment);

        $this->body = $template->bodyWithSubstitutions();
        $this->subject = $template->subject;
        $this->purpose = $template->purpose;
            
        $this->emit('templateSwitched',$this->body);
    }

    public function bodyUpdate($body)
    {
        $this->body = $body;
    }

    public function send()
    {
        if (is_null($this->template_id)) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Choose a template',
                'icon' => 'warning',
            ]);
            return;
        }

        $bulk = new BulkMailProvider;

        $bulk->recipients(collect($this->recipients)->filter()->keys())
            ->subject($this->subject)
            ->body($this->body)
            ->send();

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Sent',
            'text' => $this->rcount . ' email messages have been queued for sending',
            'timer' => 5000,
            'icon' => 'success',
        ]);

        foreach($this->recipients as &$recipient) {
            $recipient = false;
        }
        
    }
}
