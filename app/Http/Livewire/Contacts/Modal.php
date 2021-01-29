<?php

namespace App\Http\Livewire\Contacts;

use App\Contact;
use App\Contactable;
use App\Researcher;
use App\User;
use Livewire\Component;

class Modal extends Component
{

    public $editing = false;
    public $model_id;
    public $model_name;
    public $model_realname;
    public $researchers;
    public $researcher;

    public $forenames;
    public $surname;
    public $title;
    public $phone1;
    public $phone2;
    public $email1;
    public $email2;
    public $contactable;
    public $exists;

    public function mount($model,$contactable)
    {
        $this->model_id = $model->id;
        $this->exists = $model->id;
        $this->model_name = get_class($model);
        $this->model_realname = (new $contactable['contactable_type'])::NAME;

        $this->forenames = $model->forenames;
        $this->surname = $model->surname;
        $this->title = $model->title;
        $this->phone1 = $model->phone1;
        $this->phone2 = $model->phone2;
        $this->email1 = $model->email1;
        $this->email2 = $model->email2;

        $this->contactable = $contactable;
        $this->researchers = User::role('Researcher')->pluck('name','id')->toArray();

        $this->researcher = $model->researcher_id;

    }

    public function render()
    {
        return view('livewire.contacts.modal');
    }

    public function close()
    {
        $this->emit('closeModals');
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
            'title' => 'max:20',
            'phone1' => 'max:200',
            'phone2' => 'max:200',
            'email1' => 'nullable | email | max:200',
            'email2' => 'nullable | email | max:200'
        ]);

        $contact = Contact::UpdateOrCreate( ['id' => $this->model_id],
        [
            'forenames' => $this->forenames,
            'surname' => $this->surname,
            'title' => $this->title,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'email1' => $this->email1,
            'email2' => $this->email2,
            'researcher_id' => empty($this->researcher) ? 0 : $this->researcher,
        ]);

        Contactable::UpdateOrCreate(
        [
            'contact_id' => $contact->id, 
            'contactable_id' => $this->contactable['contactable_id'],
        ],
        [
            'contactable_type' => $this->contactable['contactable_type'],
            'relationship' => $this->contactable['relationship'],
        ]);

//        $this->clearForm();

        $this->editing = false;
        $this->emit('contactsUpdated');
    }

    private function clearForm()
    {
        $this->forenames = null;
        $this->surname = null;
        $this->title = null;
        $this->phone1 = null;
        $this->phone2 = null;
        $this->email1 = null;
        $this->email2 = null;
        $this->relationship = null;
        $this->researcher = null;
    }

    public function detachContact()
    {
        Contactable::where('contactable_id', $this->contactable['contactable_id'])
            ->where('contact_id', $this->contactable['contact_id'])
            ->where('contactable_type', $this->contactable['contactable_type'])
            ->delete();

        $this->emit('contactDetached');
        $this->emit('closeModals');
        $this->editing=false;
    }
}
