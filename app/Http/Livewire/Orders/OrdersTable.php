<?php

namespace App\Http\Livewire\Orders;

use App\Order;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class OrdersTable extends TableComponent
{


    public $table_class = '';
    public $thead_class = 'text-left';
    public $checkbox = true;
    public $checkbox_side = 'left';
    public $clickable_row = true;
    public $action;

    public function query()
    {
        return Order::query()->with('supplier');
    }


    public function columns()
    {
        return [
            Column::make('ID','id')->searchable()->sortable(),
            Column::make('Supplier','supplier.name'),
            Column::make('Status')->sortable(),
            Column::make('Total','total'),
            Column::make('Updated At')->sortable(),
        ];
    }

    public function rowClick($id)
    {
        return redirect(route('orders.show', $id));
    }

    public function tdClass($attribute, $value)
    {
        if ($attribute == 'total') return 'text-right ';

        return null;
    }

    public function thClass($attribute)
    {
        if ($attribute == 'total') return 'text-right w-1/12';
        // if ($attribute == 'id') return 'w-1/12';
        // if ($attribute == 'foodbank.name') return 'w-3/12';
        // if ($attribute == 'status') return 'w-1/12';
        // if ($attribute == 'createdby.name') return 'w-2/12';
        // if ($attribute == 'updated_at') return 'w-2/12';
        // if ($attribute == 'created_at') return 'w-2/12';

        return null;
    }

    public function tdPresenter($attribute, $value)
    {
        if ($attribute == 'total') return '£' .  number_format($value/100, 2);
        if ($attribute == 'updated_at') return Carbon::parse($value)->format('H:i D d.m.y');

        return $value;
    }

}