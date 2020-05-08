<?php

namespace App\Http\Livewire\Contacts;

use Livewire\Component;

class ContactCard extends Component
{
    public $contact;

    public function mount($contact)
    {
        $this->contact = $contact;
    }

    public function render()
    {
        return view('livewire.contacts.contact-card');
    }
}
