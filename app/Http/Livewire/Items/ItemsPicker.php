<?php

namespace App\Http\Livewire\Items;

use App\Item;
use Carbon\Carbon;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class ItemsPicker extends TableComponent
{
    public $clickable_row = true;
    public $checkbox = false;
    public $exists;
    public $per_page = 12;

    protected $listeners = [
        'itemAdded','itemRemoved'
    ];

    public function mount($exists=null)
    {
        $this->setTableProperties();
        $this->exists = $exists;
    }

    public function query()
    {
        return Item::query();
    }

    public function itemAdded($id)
    {
        array_push($this->exists, $id);
    }

    public function itemRemoved($id)
    {
        $this->exists = array_diff($this->exists, [$id]);
    }

    public function columns()
    {
        return [
            Column::make('','id'),
            Column::make('Code')->searchable()->sortable(),
            Column::make('Description')->searchable()->sortable(),
            Column::make('Updated','updated_at')->sortable(),
        ];
    }

    public function rowClick($id)
    {
        $this->emit('itemChosen', $id);
    }

    public function thClass($attribute)
    {
        if($attribute == 'id') return 'w-5';
        if($attribute == 'code') return 'w-2/12';
        if($attribute == 'description') return 'w-7/12';
    }
    
    public function tdClass($attribute, $value)
    {
        if ($attribute == 'description') return 'text-sm';
        return 'text-xs';
    }

    public function tdPresenter($attribute, $value)
    {
        if($attribute == 'updated_at') return Carbon::parse($value)->diffForHumans();
        if($attribute == 'id') return in_array($value,$this->exists) ? '&check;' : '';

        return $value;
    }
}
