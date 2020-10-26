<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportOrderController extends Controller
{
    public function show(Order $order)
    {
        $order->load('orderlines');

        return Excel::download(new OrderExport($order), "R4FB-order-{$order->id}.xlsx");

    }

}
