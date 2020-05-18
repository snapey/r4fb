<?php

namespace App\Http\Livewire\Clubs;

use App\Club;
use App\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClubCard extends Component
{
    public $club_id;
    public $attr;
    public $editing;
    public $confirming;
    public $showFoodbankPicker;
    public $confirmDisassociateFoodbank;

    public $name;
    public $areas;
    public $group;
    public $district;

    protected $listeners = [
        'noteAdded' => 'redo',
        'contactsUpdated' =>  'redo',
        'contactDetached' => 'redo',
        'foodbankChosen' => 'associateFoodbank'
    ];

    public function mount($club)
    {
        $this->club_id = $club->id;

        if (is_null($club->id)) {
            $this->editing = true;
            $this->setAttr(new Club);
        }
    }


    public function redo()
    {
    }

    public function render()
    {
        if ($this->redirectTo) {
            return view('livewire.clubs.club-card')->withClub(new Club());
        }

        if (is_null($this->club_id)) {
            $club = new Club;
        } else {
            $club = Club::with(['contacts', 'notes.user'])->find($this->club_id);
        }

        if (!$this->editing) {
            $this->setAttr($club);
        }

        return view('livewire.clubs.club-card')
            ->withClub($club);
    }

    public function setAttr($club)
    {
        $this->name = $club->name;
        $this->areas = $club->areas;
        $this->group = $club->group;
        $this->district = $club->district;
    }

    public function editMode()
    {
        $this->editing = true;
        $this->confirming = false;
    }

    public function save()
    {

        $club = $this->persist();

        if (is_null($this->club_id)) {
            $this->redirect(route('admin.clubs.show', $club));
        }

        $this->editing = false;
    }

    public function next()
    {

        $this->persist();

        $this->redirect(route('admin.clubs.create'));
    }

    public function persist()
    {
        $data = $this->validate([
            'name' => 'required|max:50',
            'areas' => 'max:200',
            'group' => 'max:20',
            'district' => 'max:4',
        ]);

        return Club::updateOrCreate(['id' => $this->club_id], $data);
    }

    public function confirmDelete()
    {
        $this->confirming = true;
    }

    public function kill()
    {
        $club = Club::find($this->club_id);
        $club->contacts()->detach();
        $club->delete();

        $this->redirect(route('admin.clubs.index'));
    }

    
    public function associateFoodbank($id)
    {
        $club = Club::find($this->club_id);

        $club->foodbanks()->syncWithoutDetaching($id);

        $this->showFoodbankPicker = false;
    }
    public function disassociateFoodbank($id)
    {   
        if($this->confirmDisassociateFoodbank == $id) {
            $club = Club::find($this->club_id);
            $club->foodbanks()->detach($id);
            $this->confirmDisassociateFoodbank = false;
            return;
        }
        $this->confirmDisassociateFoodbank = $id;
    }


}
