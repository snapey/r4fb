<?php

namespace App\Http\Livewire\Items;

use App\Item;
use Carbon\Carbon;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class ItemsTable extends TableComponent
{


    public $table_class = '';
    public $thead_class = 'text-left';
    public $checkbox = false;
    public $checkbox_side = 'left';
    public $clickable_row = true;
    public $sort_attribute = 'code';
    public $sort_direction = 'asc';
    // public $header_view = 'admin.contacts._header';

    public function query()
    {
        return Item::query();
    }


    public function columns()
    {
        return [
            Column::make('Code', 'code')->searchable(),
            Column::make('Description', 'description')->searchable(),
            Column::make('SKU', 'sku')->searchable(),
            Column::make('UOM', 'uom'),
            Column::make('Weight', 'weight'),
            Column::make('Generic', 'generic'),
            Column::make('Last Update','updated_at')->sortable(),
        ];
    }

    public function rowClick($id)
    {
        return redirect(route('admin.items.show', $id));
    }

    public function tdClass($attribute, $value)
    {
        if ($attribute == 'generic') return 'text-center';
        if ($attribute == 'uom') return 'text-center';

        return null;
    }

    public function thClass($attribute)
    {
        if ($attribute == 'code') return 'text-left w-1/12';
        if ($attribute == 'sku') return 'text-center w-1/12';
        if ($attribute == 'weight') return 'text-center w-1/12';
        if ($attribute == 'uom') return 'text-center w-2/12';
        if ($attribute == 'description') return 'text-left w-3/12';
        if ($attribute == 'generic') return 'w-1/12 text-center';
        // if ($attribute == 'foodbank.name') return 'w-3/12';
        // if ($attribute == 'status') return 'w-1/12';
        // if ($attribute == 'createdby.name') return 'w-2/12';
        // if ($attribute == 'updated_at') return 'w-2/12';
        // if ($attribute == 'created_at') return 'w-2/12';

        return null;
    }

    public function tdPresenter($attribute, $value)
    {
        if ($attribute == 'generic') return  $value ? 'Yes' : '';
        if ($attribute == 'updated_at') return Carbon::parse($value)->format('H:i D d.m.y');

        return $value;
    }
}
