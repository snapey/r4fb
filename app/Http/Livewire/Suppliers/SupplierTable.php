<?php

namespace App\Http\Livewire\Suppliers;

use App\Supplier;
use Carbon\Carbon;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class SupplierTable extends TableComponent
{

    public $table_class = '';
    public $thead_class = 'text-left';
    public $checkbox = false;
    public $clickable_row = true;

    public function query()
    {
        return Supplier::query();
    }

    public function columns()
    {
        return [
            Column::make('Name')->searchable()->sortable(),
            Column::make('Phone')->searchable(),
            Column::make('Account')->searchable(),
            Column::make('Updated','updated_at')->sortable(),
        ];
    }


    public function tdPresenter($attribute, $value)
    {
        // if ($attribute == 'budget') return '£' .  round($value, 2);
        // if ($attribute == 'created_at') return Carbon::parse($value)->format('H:i D d.m.y');
        if ($attribute == 'updated_at') return Carbon::parse($value)->diffForHumans();

        return $value;
    }
    
    public function rowClick($id)
    {
        return redirect(route('admin.suppliers.show', $id));
    }

}
