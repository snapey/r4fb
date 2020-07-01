<?php

namespace App\Http\Controllers;

use App\Allocation;
use Illuminate\Http\Request;

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
}
