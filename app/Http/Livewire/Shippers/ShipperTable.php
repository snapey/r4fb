<?php

namespace App\Http\Livewire\Shippers;

use App\Shipper;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class ShipperTable extends TableComponent
{

    public $table_class = '';
    public $thead_class = 'text-left';
    public $checkbox = false;
    public $clickable_row = true;

    
    public function query()
    {
        return Shipper::query();
    }

    public function columns()
    {
        return [
            Column::make('ID')->searchable()->sortable(),
            Column::make('Created At')->searchable()->sortable(),
            Column::make('Updated At')->searchable()->sortable(),
        ];
    }

    public function rowClick($id)
    {
        return redirect(route('admin.shipper.show', $id));
    }


}
