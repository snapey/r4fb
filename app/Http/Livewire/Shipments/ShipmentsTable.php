<?php

namespace App\Http\Livewire\Shipments;

use App\Model;
use App\Shipment;
use Carbon\Carbon;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class ShipmentsTable extends TableComponent
{
    public $clickable_row = true;
    public $checkbox = false;
    public $header_view = 'shipments.livewire._header';
    public $statuses;
    public $statusFilter = Shipment::PLANNED;
    public $per_page;
    public $perPageOptions = ['15' => '15', '25' => '25', '50' => '50', '100' => '100'];

    public function mount()
    {
        $this->per_page = session('per_page', 15);
        $this->statuses = [
            Shipment::PLANNED => Shipment::PLANNED, 
            Shipment::RECEIVED => Shipment::RECEIVED,
            Shipment::CANCELLED => Shipment::CANCELLED
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

    public function query()
    {
        return Shipment::with('fromAddress.addressable','toAddress.addressable','allocations')->statusScope($this->statusFilter);

    }

    public function columns()
    {
        return [
            Column::make('ID')->searchable()->sortable(),
            Column::make('From','from_address.addressable.name'),
            Column::make('To','to_address.addressable.name'),
            Column::make('Status')->searchable()->sortable(),
            Column::make('Allocations'),
            Column::make('Updated At')->sortable(),
        ];
    }

    public function thClass($attribute)
    {
        if ($attribute == 'id') return 'w-1/12';
        if ($attribute == 'from_address.addressable.name') return 'w-3/12 text-left';
        if ($attribute == 'to_address.addressable.name') return 'w-3/12 text-left';

        if ($attribute == 'updated_at') return 'w-2/12 text-left';
        if ($attribute == 'allocations') return 'text-left';
        if ($attribute == 'status') return 'w-1/12 text-left';
 
        return null;
    }
    
    public function tdClass($attribute,$value)
    {
        if ($attribute == 'allocations') return 'text-xs';
    }

    public function tdPresenter($attribute, $value)
    {
        // if ($attribute == 'total') return '£' .  number_format($value / 100, 2);
        if ($attribute == 'updated_at') return Carbon::parse($value)->format('H:i d/m/y');
        if ($attribute == 'allocations') return $this->allocationsList($value);
        return $value;
    }

    public function allocationsList($value)
    {
        return collect($value)->pluck('id')->transform(function($id) {
            return '<a class="hover:underline" href="' . route('allocations.show',$id) . '">' . $id . '</a>';
        })->implode(', ');
    }

    public function rowClick($id)
    {
        return redirect(route('shipment.show', $id));
    }


}
