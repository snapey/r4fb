<?php

namespace App\Exports;

use App\Contact;
use App\Contactable;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContactsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contactable::with('contact', 'club')->where('contactable_type', 'App\Club')->get();

    }
}
