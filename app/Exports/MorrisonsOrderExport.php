<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MorrisonsOrderExport implements FromCollection, WithHeadings, WithMapping, WithCustomCsvSettings
{    

    public function getCsvSettings(): array
    {
        return [
            'enclosure' => '',
        ];
    }

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ($this->order->orderlines);
    }

    public function map($row): array
    {
        return [
            $row->code,
            $row->description,
            $row->uom,
            $row->case_quantity,
            $row->eachPounds,
            $row->qty,
        ];
    }

    public function headings(): array
    {
        return [
            ['Product ID', 'Product Description', 'Quantity Type','Case Size','Price','Quantity'],
        ];
    }



}
