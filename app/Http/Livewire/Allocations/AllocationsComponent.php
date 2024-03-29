<?php

namespace App\Http\Livewire\Allocations;

use App\Allocation;
use App\Events\AllocationCompleteEvent;
use App\Foodbank;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class AllocationsComponent extends Component
{
    public $allocation_id;
    public $foodbank;
    public $foodbank_id;
    public $budget;
    public $status;
    public $created_by;
    public $statuses;
    public $shared_url;

    public $editing;
    public $confirming;
    public $modelName;
    public $showFoodbankPicker;

    protected $listeners = [
        'foodbankChosen' => 'associateFoodbank'
    ];

    public function mount($allocation)
    {
        $this->allocation_id = $allocation->id;

        $this->modelName = get_class($allocation);

        if (is_null($allocation->id)) {
            $this->editing = true;
            $alloc = new Allocation();
            $alloc->status = Allocation::START;
            $this->setAttr($alloc);
        } else {
            $this->shared_url = URL::signedRoute('allocation.shared',["allocation" => $this->allocation_id]);
        }

        $this->setStatuses();
    }

    public function render()
    {
        if ($this->redirectTo) {
            return view('allocations.livewire.allocations-component')->withAllocation(new Allocation());
        }

        if (is_null($this->allocation_id)) {
            $allocation = new Allocation;
            $allocation->status = Allocation::START;
            $this->status = Allocation::START;

        } else {
            $allocation = Allocation::with(['notes.user'])->find($this->allocation_id);
        }

        if (!$this->editing) {
            $this->setAttr($allocation);
        }

        return view('allocations.livewire.allocations-component')->withAllocation($allocation);
    }

    public function setAttr($allocation)
    {
        $this->status = $allocation->status;
        $this->created_by = $allocation->createdby->name ?? '';
        $this->foodbank = $allocation->foodbank->name ?? '';
        $this->foodbank_id = $allocation->foodbank->id ?? null;
        $this->budget = $allocation->budget / 100 ?? 0;
    }

    public function setStatuses()
    {
        if (is_null($this->allocation_id)) {
            $this->statuses=[
                Allocation::INPROGRESS => Allocation::INPROGRESS,
            ];
            $this->status = Allocation::INPROGRESS;

        } else {

            $this->statuses=[
                Allocation::START => Allocation::START, 
                Allocation::SHARED => Allocation::SHARED, 
                Allocation::INPROGRESS => Allocation::INPROGRESS, 
                Allocation::CONFIRMED => Allocation::CONFIRMED, 
                Allocation::SHIPPED => Allocation::SHIPPED, 
                Allocation::COMPLETE => Allocation::COMPLETE, 
                Allocation::CANCELLED => Allocation::CANCELLED, 
            ];
        }
    }

    public function editMode()
    {
        $this->editing = true;
        $this->confirming = false;
    }

    public function save()
    {

        $allocation = $this->persist();

        if (is_null($this->allocation_id)) {
            $this->redirect(route('allocations.show', $allocation));
        }

        $this->editing = false;

        if (Arr::exists($allocation->getChanges(), 'status') || $allocation->wasRecentlyCreated) {
            if ($allocation->status == Allocation::COMPLETE) {
                event(new AllocationCompleteEvent($allocation));
            }
        }
    }


    public function persist()
    {
        $this->validate([
            'foodbank' => 'required',
            'budget' => 'max:50000| numeric',
        ]);

        $allocation = is_null($this->allocation_id) 
            ? new Allocation(['user_id' => Auth::id()]) 
            : Allocation::find($this->allocation_id);

        $allocation->budget = $this->budget * 100;
        $allocation->foodbank_id = $this->foodbank_id;
        $allocation->status = $this->status;

        $allocation->save();

        return $allocation;
    }

    public function confirmDelete()
    {
        $this->confirming = true;
    }

    public function kill()
    {
        $allocation = Allocation::find($this->allocation_id);
        $allocation->stocks()->delete();
        $allocation->delete();

        $this->redirect(route('allocations.index'));
    }

    public function associateFoodbank($id)
    {
        $this->foodbank_id = $id;
        $this->foodbank = Foodbank::findOrFail($id)->name;
        $this->showFoodbankPicker = false;
    }

}
