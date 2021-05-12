<?php

namespace App\Exports;

use App\Foodbank;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FoodbanksExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Foodbank::select($this->fields())->get();
    }

    public function headings(): array
    {
        return $this->fields();
    }

    public function fields()
    {
        return [
            'name',
            'charity',
            'organisation',
            'location',
            'email',
            'website',
            'hours',
            'facebook',
            'name2',
            'phone1',
            'phone2',
            'status',
        ];
    }
}
