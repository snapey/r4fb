<?php

namespace App\Http\Livewire\Clubs;

use App\Club;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class ClubTable extends TableComponent
{

    public $table_class = '';
    public $thead_class = 'text-left';
    public $checkbox = false;
    public $clickable_row = true;
    // public $header_view = 'admin.contacts._header';


    public function query()
    {
        return Club::query();
    }

    public function mount()
    {
        $this->setTableProperties();
        $this->sort_attribute = 'name';
        $this->sort_direction = 'asc';
    }

    public function rowClick($id)
    {
        return redirect(route('admin.clubs.show', $id));
    }

    public function columns()
    {
        return [
            Column::make('Name')->searchable()->sortable(),
            Column::make('Areas')->searchable()->sortable(),
            Column::make('District')->searchable()->sortable(),
            Column::make('Group')->searchable()->sortable(),
        ];
    }

    public function thClass($attribute)
    {
        if ($attribute == 'name') return 'w-2/12';
        if ($attribute == 'areas') return 'w-6/12';
        if ($attribute == 'district') return 'w-2/12 text-center';
        if ($attribute == 'group') return 'w-2/12';

        return null;
    }
 
    public function tdClass($attribute, $value)
    {
        if ($attribute == 'name') return 'w-2/12';
        if ($attribute == 'areas') return 'w-6/12';
        if ($attribute == 'district') return 'w-2/12 text-center';
        if ($attribute == 'group') return 'w-2/12';

        return null;
    }
}
