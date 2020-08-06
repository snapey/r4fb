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


    public function query()
    {
        return Shipment::with('fromAddress.addressable','toAddress.addressable','allocations');

    }

    public function columns()
    {
        return [
            Column::make('ID')->searchable()->sortable(),
            Column::make('From','from_address.addressable.name'),
            Column::make('To','to_address.addressable.name'),
            Column::make('Allocations'),
            Column::make('Updated At')->searchable()->sortable(),
        ];
    }

    public function thClass($attribute)
    {
        dump($attribute);
        if ($attribute == 'id') return 'w-1/12';
        if ($attribute == 'from_address.addressable.name') return 'w-3/12 text-left';
        if ($attribute == 'to_address.addressable.name') return 'w-3/12 text-left';
        if ($attribute == 'updated_at') return 'w-2/12 text-left';
 
        return null;
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
