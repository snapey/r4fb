<?php

namespace App\Exports;

use App\Contact;
use App\Contactable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FoodbankContactsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contactable::with('contact','foodbank')->where('contactable_type', 'App\Foodbank')->get();
    }

    public function map($contactable): array
    {
        return [
            $contactable->contact->forenames,
            $contactable->contact->surname,
            $contactable->contact->email1,
            $contactable->contact->email2,
            $contactable->relationship,
            $contactable->foodbank->name,
        ];
    }

    public function headings(): array
    {
        return [
            'Forename',
            'Surname',
            'Email1',
            'Email2',
            'Relationship',
            'Foodbank',
        ];
    }

}
