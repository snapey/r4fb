<?php

namespace App\Exports;

use App\Contact;
use App\Contactable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContactsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contactable::with('contact', 'club')->where('contactable_type', 'App\Club')->get();

    }

    public function map($contactable): array
    {
        return [
            $contactable->contact->forenames,
            $contactable->contact->surname,
            $contactable->contact->email1,
            $contactable->contact->email2,
            $contactable->relationship,
            $contactable->club->name,
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
            'Rotary Club',
        ];
    }

}
