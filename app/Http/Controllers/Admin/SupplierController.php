<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return view('admin.suppliers.index');
    }

    public function show(Supplier $supplier)
    {
        return view('admin.suppliers.show')->withSupplier($supplier);
    }

    public function create()
    {
        return $this->show(new Supplier);
    }

}
