<?php

namespace App\Http\Livewire\Foodbanks;

use App\Foodbank;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class FoodbankTable extends TableComponent
{
    public $table_class = '';
    public $thead_class = 'text-left';
    public $checkbox=false;
    public $clickable_row = true;
    public $header_view = 'admin.foodbanks._header';


    public function mount() 
    {
        $this->setTableProperties();
        $this->sort_attribute = 'name';
        $this->sort_direction = 'asc';
    }

    public function query()
    {
        return Foodbank::query();
    }

    public function rowClick($id)
    {
        return redirect(route('admin.foodbanks.show',$id));
    }

    public function columns()
    {
        return [
            Column::make('Name')->searchable()->sortable(),
            Column::make('Location')->searchable()->sortable(),
            Column::make('Organisation')->searchable()->sortable(),
            Column::make('Charity', 'charity')->searchable()->sortable(),
            Column::make('Updated', 'updatedForHumans'),
        ];
    }


    public function thClass($attribute)
    {
        if ($attribute == 'name') return 'w-3/12';
        if ($attribute == 'location') return 'w-3/12';
        if ($attribute == 'charity') return 'w-1/12';
        if ($attribute == 'organisation') return 'w-3/12';
        if ($attribute == 'updated_at') return 'w-2/12';

        return null;
    }

    public function tdClass($attribute, $value)
    {
        if ($attribute == 'name') return 'w-3/12';
        if ($attribute == 'location') return 'w-3/12';
        if ($attribute == 'charity') return 'w-1/12';
        if ($attribute == 'organisation') return 'w-3/12 overflow-hidden';
        if ($attribute == 'updated_at') return 'w-2/12';

        return null;
    }
}
