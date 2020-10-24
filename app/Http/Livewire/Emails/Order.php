<?php

namespace App\Http\Livewire\Emails;

use App\Providers\BulkMailProvider;
use App\Template;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Vinkla\Hashids\Facades\Hashids;

class Order extends Component
{
    public $order;
    public $templates;
    public $template_id;
    public $subject;
    public $body;
    public $purpose;
    public $recipients =[];
    public $users =[];
    public $rcount;
    public $sendpdf;


    public function mount($order)
    {
        $order->unsetRelation('orderlines');
        $this->order = $order;

        $this->templates = Template::where('context','order')->get(['id','title']);
    }

    public $listeners = ['bodyUpdate'];

    public function render()
    {
        $this->order->load('supplier.contacts');
        
        $this->rcount = collect($this->recipients)->filter()->count() + collect($this->users)->filter()->count();

        return view('orders.livewire.emails');
    }

    public function updatedTemplateId()
    {   
        $template = Template::findOrNew($this->template_id);
        
        $template->setOrder($this->order);

        $this->body = $template->bodyWithSubstitutions();
        $this->subject = $template->subjectWithSubstitutions();
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

        $pdf = $this->createPDF();

        $bulk = new BulkMailProvider;

        $bulk->recipients(collect($this->recipients)->filter()->keys())
            ->users(collect($this->users)->filter()->keys())
            ->subject($this->subject)
            ->pdf($pdf)
            ->body($this->body)
            ->template('order')
            ->send();

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Sent',
            'text' => $this->rcount . ' email messages have been queued for sending',
            'timer' => 5000,
            'icon' => 'success',
        ]);

        foreach ($this->recipients as &$recipient) {
            $recipient = false;
        }
        foreach ($this->users as &$user) {
            $user = false;
        }
        
    }

    private function createPDF()
    {

        $this->order->load('orderlines', 'shipto.addressable', 'supplier.addresses', 'notes');

        $pdf = SnappyPdf::loadView('orders.pdf', ['order' => $this->order]);

        $pdf->setOption('margin-left', 15);
        $pdf->setOption('margin-right', 15);

        $filename = sprintf('R4FB-Order-' . $this->order->id);
        $filename = $filename . '-' . Hashids::encode($this->order->id);

        Storage::disk('pdfs')->put($filename,$pdf->output());

        return Storage::disk('pdfs')->url($filename);

    }
}
