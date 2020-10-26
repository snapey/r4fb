<?php

namespace App\Http\Controllers\Admin;

use App\EmailHistory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailHistoryController extends Controller
{
    public function index()
    {
        return view('admin.emailhistory')->withEmails(EmailHistory::latest()->get());
    }
}
