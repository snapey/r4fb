<?php

namespace App\Http\Livewire\Suppliers;

use App\Supplier;
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
            Column::make('Updated','updatedforhumans')->sortable()->sortUsing(function($models, $sort_attribute, $sort_direction){
                return $models->orderBy('updated_at', $sort_direction);
            }),
        ];
    }

    public function rowClick($id)
    {
        return redirect(route('admin.suppliers.show', $id));
    }

}
