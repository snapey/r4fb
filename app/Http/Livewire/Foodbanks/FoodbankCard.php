<?php

namespace App\Http\Livewire\Foodbanks;

use App\Foodbank;
use App\Shipper;
use Livewire\Component;

class FoodbankCard extends Component
{
    public $foodbank_id;
    public $attr;
    public $editing;
    public $confirming;
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
    public $phone2;
    public $name2;
    public $shipper_id;
    
    protected $listeners = [
        'noteAdded' => 'redo',
        'contactsUpdated' =>  'redo',
        'contactDetached' => 'redo',
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

    public function render()
    {
        $shippers=[];

        if($this->editing) {
            $shippers = Shipper::orderBy('name','asc')->pluck('name','id');
        }

        if($this->redirectTo){
            return view('livewire.foodbanks.foodbank-card')->withFoodbank(new Foodbank())->withShippers($shippers);
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
                ->withFoodbank($foodbank)
                ->withShippers($shippers);
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
            $this->phone2 = $foodbank->phone2;
            $this->name2 = $foodbank->name2;
            $this->shipper_id = $foodbank->shipper_id;
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
            'phone2' => 'max:20',
            'name2' => 'max:100',
            'shipper_id' => 'sometimes|integer',
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
            'phone2' => $this->phone2,
            'name2' => $this->name2,
            'shipper_id' => $this->shipper_id>0 ? $this->shipper_id : null,
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
