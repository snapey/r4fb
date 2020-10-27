<?php

namespace App\Http\Controllers;

use App\Address;
use App\Allocation;
use App\Order;
use App\Stock;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        return view('orders.index');
    }

    public function show(Order $order)
    {
        $order->load('orderlines', 'shipto.addressable', 'supplier.addresses');

        return view('orders.show')
            ->withOrder($order);
    }

    public function pdf(Order $order)
    {
        $order->load('orderlines', 'shipto.addressable', 'supplier.addresses','notes');

        $pdf = SnappyPdf::loadView('orders.pdf', compact('order'));

        $pdf->setOption('margin-left', 15);
        $pdf->setOption('margin-right', 15);

        return $pdf->download("R4FB-Order-{$order->id}.pdf");
    }

    public function create(Request $request)
    {
        abort_if(is_null($request->allocations),500);

        $allocations = Allocation::with('stocks.item')
            ->whereIn('id', $request->allocations)
            ->where('status', Allocation::START)
            ->get();

        $shipto = Address::findOrFail($request->shipto);

        $lines = $allocations->pluck('stocks')->flatten(1)->groupBy('item_id');

        DB::beginTransaction();

        $order = Order::create([
            'supplier_id' => $request->supplier,
            'shipping' => 0,
            'shipto_id' => $shipto->id,
            'shipto_type' => $shipto->addressable_type,
            'user_id' => $request->user()->id,
            'status' => Order::START,
        ]);

        foreach($lines as $stocks) {

            $orderline = $order->orderlines()->create([
                'code' => $stocks->first()->item->code ?? NULL,
                'description' => $stocks->first()->item->description ?? 'error',
                'uom' => $stocks->first()->item->uom ?? NULL,
                'sku' => $stocks->first()->item->sku ?? NULL,
                'qty' => $stocks->sum('qty'),
                'each' => $stocks->first()->each ?? 0,
                'total' => $stocks->first()->each * $stocks->sum('qty'),
            ]);

            $order->cost += $stocks->first()->each * $stocks->sum('qty');

            $stocks->each(function($stock) use ($orderline) {
                $stock->status = Stock::PURCHASING;
                $stock->orderline_id = $orderline->id;
                $stock->save();
            });

        }
        $order->save();

        $allocations->each(function($allocation) use($order) {
            $allocation->status = Allocation::INPROGRESS;
            $allocation->save();
        });


        DB::commit();

        return redirect(route('orders.show', $order));

    }

    public function marksent(Order $order)
    {
        $order->status = Order::ORDERED;
        $order->save();
        return redirect(route('orders.show', $order));
    }

}
