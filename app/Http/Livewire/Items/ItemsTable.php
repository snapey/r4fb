<?php

namespace App\Http\Livewire\Items;

use App\Exports\CatalogExport;
use App\Item;
use Carbon\Carbon;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;
use Maatwebsite\Excel\Facades\Excel;

class ItemsTable extends TableComponent
{


    public $table_class = '';
    public $thead_class = 'text-left';
    public $checkbox = false;
    public $checkbox_side = 'left';
    public $clickable_row = true;
    public $sort_attribute = 'code';
    public $sort_direction = 'asc';
    public $header_view = 'admin.items._header';
    public $statuses;
    public $statusFilter;
    public $per_page = 50;
    // public $header_view = 'admin.contacts._header';


    public function mount()
    {
        $this->statuses = (new Item)->itemStatuses();
        $this->statusFilter = session()->get('itemStatusFilter');
    }

    public function updatedStatusFilter()
    {
        session()->put('itemStatusFilter',$this->statusFilter);
    }

    public function query()
    {
        $query = Item::query();

        switch ($this->statusFilter) {
            case 'unapproved':
                $query->where('approved', false);
                break;

            case 'vatapproved':
                $query->where('vatrate','>',0)->where('approved',true);
                break;

            case 'approved':
                $query->where('approved',true);
                break;

            case 'approvedvatless':
                $query->where('approved',true)->where('vatrate',0);
                break;

            case 'newtoday':
                $query->whereDate('created_at',today());
                break;
        }

        return $query;
    }


    public function columns()
    {
        return [
            Column::make('Code', 'code')->searchable(),
            Column::make('Description', 'description')->searchable(),
            // Column::make('SKU', 'sku')->searchable(),
            Column::make('Category', 'category'),
            Column::make('UOM', 'uom'),
            Column::make('QTY', 'case_quantity'),
            Column::make('VAT', 'vatrate'),
            Column::make('Latest £', 'each'),
            Column::make('APP', 'approved')->sortable(),
            Column::make('Last Update','updated_at')->sortable(),
        ];
    }

    public function rowClick($id)
    {
        return redirect(route('admin.items.show', $id));
    }

    public function tdClass($attribute, $value)
    {
        if ($attribute == 'generic') return 'text-center';
        if ($attribute == 'uom') return 'text-center';
        if ($attribute == 'each') return 'text-right';
        if ($attribute == 'vatrate') return 'text-center';
        if ($attribute == 'approved') return 'text-center';
        if ($attribute == 'updated_at') return 'text-xs';
        if ($attribute == 'case_quantity') return 'text-center';


        return null;
    }

    public function thClass($attribute)
    {
        if ($attribute == 'code') return 'text-left';
        if ($attribute == 'sku') return 'text-center';
        if ($attribute == 'each') return 'w-1/12 text-right';
        if ($attribute == 'vatrate') return 'w-16 text-center';
        if ($attribute == 'uom') return 'w-16 text-center';
        if ($attribute == 'case_quantity') return 'w-16 text-center';
        if ($attribute == 'approved') return 'w-24 text-center';
        if ($attribute == 'description') return 'w-4/12 text-left';
        if ($attribute == 'generic') return 'text-center';

        return null;
    }

    public function tdPresenter($attribute, $value)
    {
        if ($attribute == 'generic') return  $value ? 'Yes' : '';
        if ($attribute == 'each') return  '£' . number_format($value/100,2) ? : '';
        if ($attribute == 'updated_at') return Carbon::parse($value)->format('H:i d/m/Y');
        if ($attribute == 'approved') return $value ? '&#10004;' : '-';

        return $value;
    }

}
