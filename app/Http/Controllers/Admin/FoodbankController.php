<?php

namespace App\Http\Controllers\Admin;

use App\Foodbank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FoodbankController extends Controller
{
    public function index()
    {
        return view('admin.foodbanks.index');
    }

    public function show(Foodbank $foodbank)
    {
        return view('admin.foodbanks.show')->withId($foodbank->id);
    }

    public function create()
    {
        return $this->show(new Foodbank);
    }

}
