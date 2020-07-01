<?php

namespace App\Http\Livewire;

use App\Allocation;
use Carbon\Carbon;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class Allocations extends TableComponent
{


    public $table_class = '';
    public $thead_class = 'text-left';
    public $checkbox = true;
    public $checkbox_side = 'left';
    public $clickable_row = true;
    // public $header_view = 'admin.contacts._header';

    public function query()
    {
        return Allocation::query()->with('foodbank');
    }


    public function columns()
    {
        return [
            Column::make('ID','id')->searchable()->sortable(),
            Column::make('Foodbank','foodbank.name')->searchable()->sortable(),

            Column::make('Started By','createdby.name')->sortable(),
            Column::make('Status')->sortable(),
            Column::make('Budget')->sortable(),
            Column::make('Updated At')->sortable(),
            Column::make('Created At')->sortable(),
        ];
    }

    public function rowClick($id)
    {
        return redirect(route('allocations.show', $id));
    }





    public function tdClass($attribute, $value)
    {
        if ($attribute == 'budget') return 'text-right ';

        return null;
    }

    public function thClass($attribute)
    {
        if ($attribute == 'budget') return 'text-right w-1/12';
        // if ($attribute == 'id') return 'w-1/12';
        // if ($attribute == 'foodbank.name') return 'w-3/12';
        // if ($attribute == 'status') return 'w-1/12';
        // if ($attribute == 'createdby.name') return 'w-2/12';
        // if ($attribute == 'updated_at') return 'w-2/12';
        // if ($attribute == 'created_at') return 'w-2/12';

        return null;
    }

    public function tdPresenter($attribute, $value)
    {
        if ($attribute == 'budget') return '£' .  round($value, 2);
        if ($attribute == 'created_at') return Carbon::parse($value)->format('H:i D d.m.y');
        if ($attribute == 'updated_at') return Carbon::parse($value)->format('H:i D d.m.y');

        return $value;
    }


}
