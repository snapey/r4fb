<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shipper;
use Illuminate\Http\Request;

class ShipperController extends Controller
{
    public function index()
    {
        return view('admin.shippers.index');
    }

    public function show(Shipper $shipper)
    {
        return view('admin.shippers.show')->withShipper($shipper);
    }

    public function create()
    {
        return $this->show(new Shipper());
    }

}
