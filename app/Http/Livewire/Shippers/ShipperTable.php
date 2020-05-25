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

    public function mount()
    {
        $this->setTableProperties();
        $this->sort_attribute = 'name';
        $this->sort_direction = 'asc';
    }

    public function query()
    {
        return Shipper::query();
    }

    public function columns()
    {
        return [
            Column::make('Name')->searchable()->sortable(),
            Column::make('Modes')->searchable()->sortable(),
            Column::make('Updated', 'updatedForHumans')->sortable()->sortUsing(function ($models, $sort_attribute, $sort_direction) {
                return $models->orderBy('updated_at', $sort_direction);
            }),
        ];
    }

    public function rowClick($id)
    {
        return redirect(route('admin.shippers.show', $id));
    }

}
