<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Exports\ContactsExport;
use App\Exports\FoodbankContactsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    public function index()
    {
        return view('admin.contacts.index');
    }

    public function show(Contact $contact)
    {
        return view('admin.contacts.show')->withContact($contact);
    }

    public function create()
    {
        return $this->show(new Contact);
    }

    public function export()
    {
        return Excel::download(new ContactsExport, 'contacts.xlsx');
    }

    public function foodbankContacts()
    {
        return Excel::download(new FoodbankContactsExport, 'contacts.xlsx');
    }
}
