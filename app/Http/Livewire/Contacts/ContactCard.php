<?php

namespace App\Http\Livewire\Contacts;

use App\Contactable;
use Livewire\Component;

class ContactCard extends Component
{
    public $contact;
    public $contactable;
    public $showing = false;

    protected $listeners = ['closeModal', 'contactsUpdated'];

    public function mount($contact)
    {
        $this->contact = $contact;
        $this->contactable = $contact->pivot->toArray();
    }

    public function render()
    {
        return view('livewire.contacts.contact-card');
    }

    public function contactsUpdated()
    {
        // refresh the relationship attribute
        $this->contactable['relationship'] = 
            Contactable::where('contactable_id', $this->contactable['contactable_id'])
                ->where('contact_id', $this->contactable['contact_id'])
                ->where('contactable_type', $this->contactable['contactable_type'])
                ->first()
                ->relationship;
        
    }

    public function showModal()
    {
        $this->showing = true;
    }

    public function closeModal()
    {
        $this->showing = false;
    }
}