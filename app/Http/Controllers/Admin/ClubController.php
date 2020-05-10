<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ClubController extends Controller
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

}
