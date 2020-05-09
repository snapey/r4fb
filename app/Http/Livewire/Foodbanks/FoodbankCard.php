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
    
    public $name;
    public $charity;
    public $organisation;
    public $location;
    public $email;
    public $website;
    
    protected $listeners = [
        'noteAdded' => 'redo',
        'contactsUpdated' =>  'redo',
        'contactDetached' => 'redo',
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


    public function redo()
    {
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
        ]);

        return Foodbank::updateOrCreate(['id' => $this->foodbank_id], [
            'name' => $this->name,
            'charity' => $this->charity,
            'organisation' => $this->organisation,
            'location' => $this->location,
            'email' => $this->email,
            'website' => $this->website,
        ]);

    }

    public function confirmDelete()
    {
        $this->confirming = true;
    }

    public function kill()
    {
        Foodbank::destroy($this->foodbank_id);
        $this->redirect(route('admin.foodbanks.index'));

    }
}
