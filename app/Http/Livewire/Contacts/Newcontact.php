<?php

namespace App\Http\Livewire\Contacts;

use App\Contact;
use App\Contactable;
use Livewire\Component;

class Newcontact extends Component
{
    public $editing = false;
    public $showing = false;
    public $model_id;
    public $model_name;

    public $forenames;
    public $surname;
    public $phone1;
    public $phone2;
    public $email1;
    public $email2;

    public $contactable;

    public $candidates = null;
    public $exists = null;

    public function mount($model)
    {
        $this->model_id = $model->id;
        $this->model_name = get_class($model);

        $this->contactable = [
            'contact_id' => null,
            'contactable_id' => $model->id,
            'contactable_type' => get_class($model), 
            'relationship' => null,
        ];
    }

    public function render()
    {
        return view('livewire.contacts.newcontact');
    }

    public function add()
    {
        $this->editing = true;
        $this->showing = true;
    }

    public function close()
    {
        $this->clearForm();
        $this->editing = false;
        $this->showing = false;
        $this->emit('contactsUpdated');
    }

    public function editMode()
    {
        $this->editing = true;
    }

    public function save()
    {
        $this->validate([
            'forenames' => 'max:200',
            'surname' => 'required | max:200',
            'phone1' => 'max:200',
            'phone2' => 'max:200',
            'email1' => 'nullable | email | max:200',
            'email2' => 'nullable |email | max:200'
        ]);

        $contact = Contact::updateOrCreate(
            ['id' => $this->exists],
            [
                'forenames' => $this->forenames,
                'surname' => $this->surname,
                'phone1' => $this->phone1,
                'phone2' => $this->phone2,
                'email1' => $this->email1,
                'email2' => $this->email2,
            ]
        );

        Contactable::create([
            'contact_id' => $contact->id,
            'contactable_id' => $this->model_id,
            'contactable_type' => $this->model_name,
            'relationship' => $this->contactable['relationship'],
        ]);

        $this->clearForm();
        $this->editing = false;
        $this->showing = false;
        $this->emit('contactsUpdated');
    }

    private function clearForm()
    {
        $this->forenames = null;
        $this->surname = null;
        $this->phone1 = null;
        $this->phone2 = null;
        $this->email1 = null;
        $this->email2 = null;
        $this->contactable['relationship'] = null;
        $this->candidates = null;
        $this->exists = null;

    }

    // functionality to handle typing in a surname and having it offer others contacts
    // as candidates for this contact.  The user can dismiss or pick one. Then it 
    // becomes a case of using the selected contact but creating a new relationship

    public function updatedSurname()
    {
        $this->candidates = Contact::query()
            ->where('surname',$this->surname)
            ->get();
    }

    public function selectContact($id)
    {
        $contact = Contact::findOrFail($id);

        $this->forenames = $contact->forenames;
        $this->surname = $contact->surname;
        $this->phone1 = $contact->phone1;
        $this->phone2 = $contact->phone2;
        $this->email1 = $contact->email1;
        $this->email2 = $contact->email2;

        $this->exists = $id;

    }

}
