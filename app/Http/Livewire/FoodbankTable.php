<?php

namespace App\Http\Livewire;

use App\Foodbank;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class FoodbankTable extends TableComponent
{
    public $table_class = '';
    public $thead_class = 'text-left';
    public $checkbox=false;
    public $clickable_row = true;
    public $clicktarget;

    public function mount() 
    {
        $this->setTableProperties();
        $this->clicktarget = route('admin.foodbanks.index');
    }

    public function query()
    {
        return Foodbank::query();
    }


    public function columns()
    {
        return [
            Column::make('Name')->searchable()->sortable(),
            Column::make('Location')->searchable()->sortable(),
            Column::make('Charity No', 'charity')->searchable()->sortable(),
            Column::make('Organisation')->searchable()->sortable(),
            Column::make('Updated', 'updatedForHumans'),
        ];
    }
}
