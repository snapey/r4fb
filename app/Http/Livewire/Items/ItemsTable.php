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
    public $per_page = 50;
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
            // Column::make('SKU', 'sku')->searchable(),
            Column::make('Category', 'category'),
            Column::make('UOM', 'uom'),
            Column::make('QTY', 'case_quantity'),
            Column::make('Latest £', 'each'),
            // Column::make('Generic', 'generic'),
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
        if ($attribute == 'each') return 'text-right';
        if ($attribute == 'updated_at') return 'text-xs';
        if ($attribute == 'case_quantity') return 'text-center';


        return null;
    }

    public function thClass($attribute)
    {
        if ($attribute == 'code') return 'text-left';
        if ($attribute == 'sku') return 'text-center';
        if ($attribute == 'each') return 'w-1/12 text-right';
        if ($attribute == 'uom') return 'w-1/12 text-center';
        if ($attribute == 'case_quantity') return 'w-1/12 text-center';
        if ($attribute == 'description') return 'w-4/12 text-left';
        if ($attribute == 'generic') return 'text-center';

        return null;
    }

    public function tdPresenter($attribute, $value)
    {
        if ($attribute == 'generic') return  $value ? 'Yes' : '';
        if ($attribute == 'each') return  '£' . number_format($value/100,2) ? : '';
        if ($attribute == 'updated_at') return Carbon::parse($value)->format('H:i d/m/Y');

        return $value;
    }
}
