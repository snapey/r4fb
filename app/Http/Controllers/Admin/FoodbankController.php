<?php

namespace App\Http\Controllers\Admin;

use App\Exports\FoodbanksExport;
use App\Foodbank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FoodbankController extends Controller
{
    public function index()
    {
        return view('admin.foodbanks.index');
    }

    public function show(Foodbank $foodbank)
    {
        return view('admin.foodbanks.show')->withFoodbank($foodbank);
    }

    public function create()
    {
        return $this->show(new Foodbank);
    }

    public function export()
    {
        return Excel::download(new FoodbanksExport, 'foodbanks.xlsx');
    }

}
