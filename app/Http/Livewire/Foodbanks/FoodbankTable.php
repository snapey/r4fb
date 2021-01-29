<?php

namespace App\Http\Livewire\Foodbanks;

use App\Foodbank;
use Carbon\Carbon;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class FoodbankTable extends TableComponent
{
    public $table_class = '';
    public $thead_class = 'text-left';
    public $checkbox=false;
    public $clickable_row = true;
    public $header_view = 'admin.foodbanks._header';
    public $statuses;
    public $statusFilter=0;
    public $per_page;
    public $perPageOptions = ['15'=>'15','25'=>'25','50'=>'50','100'=>'100'];

    public function mount() 
    {
        $this->setTableProperties();
        $this->sort_attribute = 'name';
        $this->sort_direction = 'asc';
        $this->statuses = (new Foodbank)->foodbankStatuses();

        $this->per_page = session('per_page',15);
    }

    public function updated($key,$value)
    {
        if($key == 'per_page') {
            session()->put(['per_page' => $value]);
        }
        if($key == 'statusFilter') {
            $this->resetPage();
        }
    }

    public function query()
    {
        return Foodbank::query()->myFoodbanks()->statusScope($this->statusFilter);
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
            Column::make('Stat.', 'shortStatusForHumans')->sortable()
                ->sortUsing(function($models, $sort_attribute, $sort_direction){
                    return $models->orderBy('status',$sort_direction);
                }),
            Column::make('Char#', 'charity')->searchable(),
            Column::make('Updated', 'updated_at')->sortable(),
        ];
    }

    public function tdPresenter($attribute, $value)
    {
        if ($attribute == 'updated_at') return Carbon::parse($value)->diffForHumans();

        return $value;
    }

    public function thClass($attribute)
    {
        if ($attribute == 'name') return 'w-3/12';
        if ($attribute == 'location') return 'w-2/12';
        if ($attribute == 'charity') return 'w-1/12';
        if ($attribute == 'shortStatusForHumans') return 'w-1/12';
        if ($attribute == 'organisation') return 'w-2/12';
        if ($attribute == 'updatedForHumans') return 'w-2/12';

        return null;
    }

    public function tdClass($attribute, $value)
    {
        if ($attribute == 'name') return 'text-sm';
        if ($attribute == 'location') return 'text-sm';
        if ($attribute == 'charity') return 'text-sm';
        if ($attribute == 'shortStatusForHumans') return 'text-sm';
        if ($attribute == 'organisation') return 'overflow-hidden text-sm';
        if ($attribute == 'updatedForHumans') return 'text-sm';

        return null;
    }

}
