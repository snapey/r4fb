<?php

namespace App\Http\Controllers;

use App\Allocation;
use App\Foodbank;
use App\Shipper;
use App\Supplier;
use Illuminate\Http\Request;

class PrepareOrdersController extends Controller
{
    public function show(Request $request)
    {
        $allocations = Allocation::with('foodbank.addresses','stocks.item')->whereIn('id',$request->allocations)->where('status',Allocation::START)->get();

        return $this->prepareView($allocations);
    }

    public function single(Request $request, Allocation $allocation)
    {
        $allocation->load('foodbank.addresses', 'stocks.item');

        $allocations = collect()->push($allocation);

        return $this->prepareView($allocations);
    }

    public function prepareView($allocations)
    {

        $lines = $allocations->pluck('stocks')->flatten(1)->groupBy('item_id');

        return view('orders.prepare')
            ->withAllocations($allocations)
            ->withLines($lines)
            ->withSuppliers(Supplier::all())
            ->withShippers(Shipper::with('addresses')->get(['id', 'name']));
    }

}
