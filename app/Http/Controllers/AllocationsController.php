<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllocationsController extends Controller
{
    public function index()
    {
        return view('allocations.index');
    }

    public function create()
    {
        return 'creating';
    }

    public function show()
    {
        return 'showing';
    }
}
