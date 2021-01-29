<?php

namespace App\Http\Livewire\Contacts;

use App\Contact;
use App\Contactable;
use App\User;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Livewire\Component;

class ContactMainCard extends Component
{

    public $editing = false;
    public $exists;
    public $contactable;
    public $model_id;
    public $confirming;
    public $researchers;
    public $researcher;


    public $forenames;
    public $surname;
    public $title;
    public $phone1;
    public $phone2;
    public $email1;
    public $email2;


    public function mount($contact)
    {
        $this->exists = $contact->id;
        $this->model_id = $contact->id;

        $this->forenames = $contact->forenames;
        $this->surname = $contact->surname;
        $this->title = $contact->title;
        $this->phone1 = $contact->phone1;
        $this->phone2 = $contact->phone2;
        $this->email1 = $contact->email1;
        $this->email2 = $contact->email2;

        $this->researchers = User::role('Researcher')->pluck('name', 'id')->toArray();
        $this->researcher = $contact->researcher_id;
    }


    protected $listeners = [
        'noteAdded' => 'redo',
    ];

    public function redo(){}

    public function render()
    {
        if ($this->redirectTo) {
            return view('livewire.contacts.contact-main-card')->withContact(new Contact());
        }

        if(is_null($this->model_id)){
            $contact = new Contact;
            $this->editing = true;
        } else {
            $contact = Contact::with(['notes','foodbanks','suppliers','shippers'])->findOrFail($this->model_id);
        }

        return view('livewire.contacts.contact-main-card')->withContact($contact);

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
            'title'  => 'max:20',
            'phone1' => 'max:200',
            'phone2' => 'max:200',
            'email1' => 'nullable | email | max:200',
            'email2' => 'nullable | email | max:200'
        ]);

        $contact = Contact::UpdateOrCreate(
            ['id' => $this->model_id],
            [
                'forenames' => $this->forenames,
                'surname' => $this->surname,
                'title' => $this->title,
                'phone1' => $this->phone1,
                'phone2' => $this->phone2,
                'email1' => $this->email1,
                'email2' => $this->email2,
                'researcher_id' => empty($this->researcher) ? 0 : $this->researcher,

            ]
        );

        //        $this->clearForm();

        $this->editing = false;
        $this->emit('contactsUpdated');

        if(is_null($this->model_id)) {
            $this->redirect(route('admin.contacts.show', $contact->id));
        }
    }

    private function clearForm()
    {
        $this->forenames = null;
        $this->surname = null;
        $this->titile = null;
        $this->phone1 = null;
        $this->phone2 = null;
        $this->email1 = null;
        $this->email2 = null;
        $this->relationship = null;
    }

    public function confirmDelete()
    {
        $this->confirming = true;
    }

    public function kill()
    {
        Contact::destroy($this->model_id);
        Contactable::where('contact_id',$this->model_id)->delete();

        $this->redirect(route('admin.contacts.index'));
    }

    public function cancel()
    {
        if($this->editing) {
            $this->editing=false;
            $this->confirming = false;
            return;
        }
        
        if ($this->confirming) {
            $this->confirming = false;
            return;
        }

        $this->redirect(route('admin.contacts.index'));
    }

}
