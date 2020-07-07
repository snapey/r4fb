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
        $allocations = Allocation::with('foodbank:id,name','stocks.item')->whereIn('id',$request->allocations)->where('status',Allocation::START)->get();

        $lines = $allocations->pluck('stocks')->flatten(1)->groupBy('item_id');
    //    return Shipper::with('addresses')->get(['id','name']);
        return view('orders.prepare')
            ->withAllocations($allocations)
            ->withLines($lines)
            ->withSuppliers(Supplier::all())
            ->withShippers(Shipper::with('addresses')->get(['id','name']))
            ->withFoodbanks(Foodbank::with('addresses')->get(['id','name']));
    }
}
