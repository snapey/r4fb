<?php

namespace App\Http\Livewire\Shippers;

use App\Shipper;
use Carbon\Carbon;
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
            Column::make('Satellite','is_satellite')->sortable(),
            Column::make('Updated', 'updated_at')->sortable(),
        ];
    }

    public function tdPresenter($attribute, $value)
    {
        if ($attribute == 'updated_at') return Carbon::parse($value)->diffForHumans();
        if ($attribute == 'is_satellite') return $value ? 'Yes' : '';

        return $value;
    }

    public function rowClick($id)
    {
        return redirect(route('admin.shippers.show', $id));
    }

}
