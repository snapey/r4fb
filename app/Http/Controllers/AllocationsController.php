<?php

namespace App\Http\Controllers;

use App\Allocation;
use App\Stock;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AllocationsController extends Controller
{
    public function index()
    {
        return view('allocations.index');
    }

    public function create()
    {
        return $this->show(new Allocation);
    }

    public function show(Allocation $allocation)
    {
        $allocation->load('notes');
        return view('allocations.show')->withAllocation($allocation);
    }

    public function copy(Allocation $allocation)
    {
        $allocation->load('stocks.item');

        $newAllocation = Allocation::create([
            'foodbank_id' => $allocation->foodbank_id,
            'user_id' => $allocation->user_id,
            'status' => Allocation::START,
            'budget' => $allocation->budget,
            'total' => $allocation->total,
        ]);

        foreach($allocation->stocks as $stock) {
            Stock::create([
                'item_id' => $stock->item_id,
                'allocation_id' => $newAllocation->id,
                'qty' => $stock->qty,
                'status' => Stock::DRAFT,
                'each' => $stock->each,
                'total' => $stock->total,
            ]);
        }

        Alert::success('Allocation duplicated','You should change the foodbank to be the correct one for this new allocation');
        return redirect(route('allocations.show',$newAllocation));
    }
}
