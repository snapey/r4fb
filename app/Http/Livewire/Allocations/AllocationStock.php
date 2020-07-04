<?php

namespace App\Http\Livewire\Allocations;

use App\Allocation;
use App\Item;
use App\Stock;
use Livewire\Component;

class AllocationStock extends Component
{
    public $allocation_id;
    public $stocks;
    public $confirming = false;
    public $allocation_total;

    protected $listeners = [
        'itemChosen','itemRemoved'
    ];

    public function mount(Allocation $allocation)
    {
        $this->allocation_id = $allocation->id;
        $this->stocks = $allocation->stocks->toArray();
    }

    public function render()
    {
        $stocks = Stock::with('item')->where('allocation_id', $this->allocation_id)->get();

        $this->allocation_total = number_format($stocks->sum('total') / 100,2);

        $this->stocks = $stocks->toArray();

        return view('allocations.livewire.allocations-stock');
    }

    public function updating($name,$value)
    {
        $vars=explode('.',$name);
        
        if($vars[2] == 'qty') {
            $stock = Stock::find($this->stocks[$vars[1]]['id']);
            $stock->qty = intval($value);
            $stock->total = $stock->qty * $stock->each;
            $stock->save();
        }

    }

    public function presenter($attribute, $value)
    {
        if ($attribute == 'each') return number_format($value / 100, 2);
        if ($attribute == 'total') return number_format($value / 100, 2);
        return $value;
    }

    public function itemChosen($id)
    {
        //add item to this allocation - as long as it is not already there
        //adds stock record referencing this allocation and the suggested item id

        $stock = Stock::create([
            'item_id' => $id,
            'allocation_id' => $this->allocation_id,
            'status' => Stock::DRAFT,
            'each' => Item::find($id)->each,
        ]);

        $this->emit('itemAdded',$id);
    }

    public function itemRemoved()
    {
        // simply re-render
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function kill()
    {
        $stock = Stock::find($this->confirming);
        $this->emit('itemRemoved', $stock->item_id);
        $stock->delete();
        $this->confirming = false;
    }

}
