<?php

namespace App\Http\Livewire\Foodbanks;

use App\Foodbank;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class FoodbanksPicker extends TableComponent
{
    public $clickable_row = true;
    public $checkbox = false;
    public $per_page = 12;

    public function query()
    {
        return Foodbank::orderBy('name');
    }

    public function columns()
    {
        return [
            Column::make('Name')->searchable()->sortable(),
            Column::make('Location')->searchable()->sortable(),
        ];
    }

    public function tdPresenter($attribute, $value)
    {
        return $value;
    }

    public function rowClick($id)
    {
        $this->emit('foodbankChosen',$id);

    }
}
