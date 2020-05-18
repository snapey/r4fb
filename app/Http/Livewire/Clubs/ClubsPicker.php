<?php

namespace App\Http\Livewire\Clubs;

use App\Club;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class ClubsPicker extends TableComponent
{
    public $clickable_row = true;
    public $checkbox = false;
    public $per_page = 12;

    public function query()
    {
        return Club::orderBy('name','asc');
    }

    public function columns()
    {
        return [
            Column::make('Name')->searchable()->sortable(),
            Column::make('District')->searchable()->sortable(),
        ];
    }

    public function rowClick($id)
    {
        $this->emit('clubChosen', $id);
    }
}
