<?php

namespace App\Http\Livewire\Allocations;

use App\Allocation;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class AllocationsTable extends TableComponent
{


    public $table_class = '';
    public $thead_class = 'text-left';
    public $checkbox = true;
    public $checkbox_side = 'left';
    public $clickable_row = true;
    public $header_view = 'allocations._header';
    public $action;
    public $statuses;
    public $statusFilter;
    public $per_page;
    public $perPageOptions = ['15' => '15', '25' => '25', '50' => '50', '100' => '100'];


    public function mount()
    {
        $this->per_page = session('per_page', 15);

        $this->statusFilter = session()->get('allocations.filter');
        
        $this->statuses = [
            Allocation::START => Allocation::START,
            Allocation::SHARED => Allocation::SHARED,
            Allocation::INPROGRESS => Allocation::INPROGRESS,
            Allocation::CONFIRMED => Allocation::CONFIRMED,
            Allocation::SHIPPED => Allocation::SHIPPED,
            Allocation::COMPLETE => Allocation::COMPLETE,
            Allocation::CANCELLED => Allocation::CANCELLED,
        ];

    }

    public function updated($key, $value)
    {
        if ($key == 'per_page') {
            session()->put(['per_page' => $value]);
        }
        if ($key == 'statusFilter') {
            $this->resetPage();
        }
    }

    public function updatedStatusFilter($value)
    {
        session()->put(['allocations.filter' => $this->statusFilter]);
    }

    public function query()
    {
        return Allocation::query()->with('foodbank.shipper','createdby')->statusScope($this->statusFilter);
    }


    public function columns()
    {
        return [
            Column::make('ID','id')->searchable()->sortable(),
            Column::make('','foodbank.id')->searchable(),
            Column::make('Foodbank','foodbank.name')->searchable(),
            Column::make('Via','foodbank.shipper.name')->searchable(),
            Column::make('Started By','createdby.name'),
            Column::make('Status')->sortable(),
            Column::make('Total','total'),
            Column::make('Updated At')->sortable(),
            // Column::make('Created At')->sortable(),
        ];
    }

    public function rowClick($id)
    {
        return redirect(route('allocations.show', $id));
    }





    public function tdClass($attribute, $value)
    {
        if ($attribute == 'budget') return 'text-right ';
        if ($attribute == 'total') return 'text-right ';

        return null;
    }

    public function thClass($attribute)
    {
        if ($attribute == 'id') return 'text-left w-20';
        if ($attribute == 'budget') return 'text-right w-1/12';
        if ($attribute == 'total') return 'text-right w-1/12';
        if ($attribute == 'foodbank.id') return 'text-center w-8';
        if ($attribute == 'foodbank.name') return 'w-2/12';
        if ($attribute == 'foodbank.shipper.name') return 'w-2/12';

        // if ($attribute == 'id') return 'w-1/12';
        // if ($attribute == 'status') return 'w-1/12';
        // if ($attribute == 'createdby.name') return 'w-2/12';
        // if ($attribute == 'updated_at') return 'w-2/12';
        // if ($attribute == 'created_at') return 'w-2/12';

        return null;
    }

    public function tdPresenter($attribute, $value)
    {
        if ($attribute == 'budget') return '£' .  number_format($value/100, 0);
        if ($attribute == 'total') return '£' .  number_format($value/100, 2);
        if ($attribute == 'updated_at') return Carbon::parse($value)->format('H:i d/m/y');
        if ($attribute == 'foodbank.id') return $this->foodbankLink($value);
        return $value;
    }

    public function foodbankLink($value)
    {
        if (is_null($value)) return;

       return '<a href="' . route('admin.foodbanks.show', $value) . '">
                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor"
                viewBox="0 0 24 24" class="h-5 text-indigo-700 hover:text-indigo-500"><path d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg></a>';
    }

    public function go()
    {
        if($this->action == 'create') {

            $this->redirect(route('prepare-orders', ['allocations' => $this->checkbox_values]));
            
        }

        if($this->action == 'shipment') {

            $this->redirect(route('shipment.multi',['allocations' => $this->checkbox_values]));

        }

    }
}
