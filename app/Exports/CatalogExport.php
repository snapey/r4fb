<?php

namespace App\Exports;

use App\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class CatalogExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize
{

    public $statusFilter;

    public function __construct($statusFilter)
    {
        $this->statusFilter = $statusFilter;
    }

    public function headings(): array
    {
        return [
            'Code',
            'Description',
            'UOM',
            'Per Case',
            'Each',
        ];
    }

    public function map($item): array
    {
        return [
            $item->code,
            $item->description,
            $item->uom,
            $item->case_quantity,
            number_format($item->each/100,2),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'E' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Item::query();

        switch ($this->statusFilter) {
            case 'unapproved':
                $query->where('approved', false);
                break;

            case 'vatapproved':
                $query->where('vatrate', '>', 0)->where('approved', true);
                break;

            case 'approved':
                $query->where('approved', true);
                break;

            case 'approvedvatless':
                $query->where('approved', true)->where('vatrate', 0);
                break;

            case 'newtoday':
                $query->whereDate('created_at', today());
                break;
        }

        return $query->get();

    }
}
