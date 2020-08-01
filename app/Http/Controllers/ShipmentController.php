<?php

namespace App\Http\Controllers;

use App\Allocation;
use App\Shipment;
use App\Shipper;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShipmentController extends Controller
{
    public function index()
    {
        return view('shipments.index');
    }

    public function create(Allocation $allocation)
    {
        $allocation->load('stocks.item','foodbank.clubs','foodbank.addresses');

        return view('shipments.create')
            ->withAllocation($allocation)
            ->withFoodbank($allocation->foodbank)
            ->withShippers(Shipper::with('addresses')->get(['id','name']));
    }

    public function multi(Request $request)
    {
        $allocations = Allocation::with('stocks.item', 'foodbank.clubs')->find($request->allocations);
        abort_if($allocations->count()==0,500);

        return view('shipments.multi')
            ->withAllocations($allocations)
            ->withShippers(Shipper::with('addresses')->get(['id', 'name']));
    }

    public function store(Request $request)
    {
        //validate

        $shipment = Shipment::create([
            'from_id' => $request->from,
            'to_id' => $request->shipto,
            'user_id' => Auth::id(),
        ]);

        $i=1;
        foreach($request->allocation as $allocation) {
            $shipment->allocations()->attach($allocation,['sub'=>$i++]);
        }

        return redirect(route('shipment.show',$shipment));
    }
    
    public function show(Request $request, Shipment $shipment)
    {
        $shipment->load('fromAddress.addressable','toAddress.addressable','allocations.stocks');

        // return $shipment;
        return view('shipments.show')->withShipment($shipment);
    }

    public function singlepdf(Shipment $shipment, Allocation $allocation)
    {
        $shipment->load('fromAddress.addressable', 'toAddress.addressable','notes');
        $allocation->load('stocks.item');
        $sub = DB::table('allocation_shipment')
            ->select('sub')
            ->where('allocation_id',$allocation->id)
            ->where('shipment_id',$shipment->id)
            ->first();

        // $pdf = App::make('dompdf.wrapper');
 
        // $pdf->loadView('shipments.pdf', compact(['shipment','allocation','sub']));

        // return $pdf->download("R4FB-Shipment-{$shipment->id}-{$sub->sub}.pdf");

        $pdf = SnappyPdf::loadView('shipments.pdf', compact(['shipment', 'allocation', 'sub']));

        return $pdf->download("R4FB-Shipment-{$shipment->id}-{$sub->sub}.pdf");


    }


    public function multipdf(Shipment $shipment)
    {
        $shipment->load('fromAddress.addressable', 'toAddress.addressable', 'notes','allocations.stocks.item');

        $pdf = SnappyPdf::loadView('shipments.pdf-multi', compact(['shipment']));

        return $pdf->download("R4FB-Shipment-{$shipment->id}-all.pdf");
    }



}
