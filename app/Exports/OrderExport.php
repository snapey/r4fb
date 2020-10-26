<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrderExport implements FromCollection, WithHeadings, WithColumnFormatting, WithMapping, ShouldAutoSize, WithStyles
{

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
            $row->qty,
            $row->eachPounds,
            $row->totalPounds,
        ];
    }

    public function headings(): array
    {
        return [
            ['Rotary4Foodbanks Order: '. $this->order->id],
            ['Code', 'Description', 'Quantity', 'Each', 'Total'],
            [' '],
        ];
    }


    public function columnFormats(): array
    {
        return [
            'A' => '#',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:E1');

        return [
            1    => ['font' => ['bold' => true,'size'=>20]],
            2    => ['font' => ['bold' => true]],
        ];
    }

}
