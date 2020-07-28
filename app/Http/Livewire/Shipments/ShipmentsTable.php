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
        return Shipment::with('fromAddress','toAddress','allocations');

    }

    public function columns()
    {
        return [
            Column::make('ID')->searchable()->sortable(),
            // Column::make('From','fromAddress.address1'),
            // Column::make('To','toAddress'),
            Column::make('Allocations'),
            Column::make('Updated At')->searchable()->sortable(),
        ];
    }

    public function tdPresenter($attribute, $value)
    {
        // if ($attribute == 'total') return '£' .  number_format($value / 100, 2);
        if ($attribute == 'updated_at') return Carbon::parse($value)->format('H:i D d.m.y');
        if ($attribute == 'allocations') return collect($value)->implode('id', ', ');
        return $value;
    }


    public function rowClick($id)
    {
        return redirect(route('shipment.show', $id));
    }


}
