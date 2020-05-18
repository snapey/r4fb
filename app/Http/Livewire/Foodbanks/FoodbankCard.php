<?php

namespace App\Http\Livewire\Foodbanks;

use App\Foodbank;
use App\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FoodbankCard extends Component
{
    public $foodbank_id;
    public $attr;
    public $editing;
    public $confirming;
    public $addressShowing;
    public $createAddress;
    public $showClubsPicker;
    public $confirmDisassociateClub;

    public $name;
    public $charity;
    public $organisation;
    public $location;
    public $email;
    public $website;
    public $facebook;
    public $hours;
    public $phone1;
    public $name2;
    
    protected $listeners = [
        'noteAdded' => 'redo',
        'contactsUpdated' =>  'redo',
        'contactDetached' => 'redo',
        'closeAddressModal',
        'clubChosen' => 'associateClub',
    ];

    public function mount($id)
    {
        $this->foodbank_id = $id;
        if(is_null($id)){
            $this->editing=true;
            $foodbank = new Foodbank;
            $this->setAttr($foodbank);

        }
    }


    public function redo(){}

    public function closeAddressModal()
    {
        $this->addressShowing = false;
        $this->createAddress = false;
    }

    public function render()
    {
        if($this->redirectTo){
            return view('livewire.foodbanks.foodbank-card')->withFoodbank(new Foodbank());
        }

        if(is_null($this->foodbank_id)) {
            $foodbank = new Foodbank;
        } else {
            $foodbank = Foodbank::with(['addresses', 'contacts', 'notes.user'])->find($this->foodbank_id);
        }

        if(!$this->editing) {
            $this->setAttr($foodbank);
        }

        return view('livewire.foodbanks.foodbank-card')
                ->withFoodbank($foodbank);
    }

    public function setAttr($foodbank)
    {   
            $this->name = $foodbank->name;
            $this->charity = $foodbank->charity;
            $this->organisation = $foodbank->organisation;
            $this->location = $foodbank->location;
            $this->email = $foodbank->email;
            $this->website = $foodbank->website;
            $this->facebook = $foodbank->facebook;
            $this->hours = $foodbank->hours;
            $this->phone1 = $foodbank->phone1;
            $this->name2 = $foodbank->name2;
    }

    public function editMode()
    {
        $this->editing = true;
        $this->confirming = false;
    }

    public function save()
    {

        $foodbank = $this->persist();

        if(is_null($this->foodbank_id)) {
            $this->redirect(route('admin.foodbanks.show', $foodbank));
        }

        $this->editing = false;
    }

    public function next() {

        $this->persist();

        $this->redirect(route('admin.foodbanks.create'));

    }

    public function persist()
    {
        $data = $this->validate([
            'name' => 'required|max:200',
            'charity' => 'max:10',
            'organisation' => 'max:100',
            'location' => 'max:100',
            'email' => 'nullable|email|max:100',
            'website' => 'max:100',
            'facebook' => 'max:100',
            'hours' => 'max:200',
            'phone1' => 'max:20',
            'name2' => 'max:100',
        ]);

        return Foodbank::updateOrCreate(['id' => $this->foodbank_id], [
            'name' => $this->name,
            'charity' => $this->charity,
            'organisation' => $this->organisation,
            'location' => $this->location,
            'email' => $this->email,
            'website' => $this->website,
            'facebook' => $this->facebook,
            'hours' => $this->hours,
            'phone1' => $this->phone1,
            'name2' => $this->name2,
        ]);

    }

    public function confirmDelete()
    {
        $this->confirming = true;
    }

    public function kill()
    {
        $model = Foodbank::find($this->foodbank_id);
        $model->contacts()->detach();
        $model->clubs()->detach();
        $model->delete();

        $this->redirect(route('admin.foodbanks.index'));
    }

    // functions to deal with the showing of the address edit card
    
    public function showAddress($address)
    {
        $this->addressShowing = $address;
    }

    public function newAddress()
    {
        $this->createAddress=true;
    }


    public function associateClub($id)
    {
        $foodbank = Foodbank::find($this->foodbank_id);
        $foodbank->clubs()->syncWithoutDetaching($id);

        $this->showClubsPicker = false;
    }

    public function disassociateClub($id)
    {
        if ($this->confirmDisassociateClub == $id) {
            $foodbank = Foodbank::find($this->foodbank_id);
            $foodbank->clubs()->detach($id);
            $this->confirmDisassociateClub = false;
            return;
        }
        $this->confirmDisassociateClub = $id;
    }


}
