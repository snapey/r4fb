<?php

namespace App\Http\Livewire\Allocations;

use App\Allocation;
use App\Item;
use App\Stock;
use Illuminate\Support\Arr;
use Livewire\Component;

class AllocationStock extends Component
{
    public $allocation_id;
    public $stocks;
    public $confirming = false;
    public $allocation_total;
    public $allocation_status;
    public $case_count;

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
        $allocation = Allocation::with('stocks.item')->find($this->allocation_id);

        $this->case_count = $allocation->stocks->sum('qty');

        $total = $allocation->stocks->sum('total');

        if ($total != $allocation->total) {
            $allocation->total = $total;
            $allocation->save();
        }

        $this->allocation_total = number_format($total / 100,2);
        $this->allocation_status = $allocation->status;

        $this->stocks = $allocation->stocks->toArray() ?? [];

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
        if(Arr::where($this->stocks,function($stock) use($id) {
                return $stock['item_id'] == $id;
            })) {
            return;
        };

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
