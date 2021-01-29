<?php

namespace App\Exports;

use App\Foodbank;
use Maatwebsite\Excel\Concerns\FromCollection;

class FoodbanksExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Foodbank::all();
    }
}
