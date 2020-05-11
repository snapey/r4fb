<?php

namespace App\Http\Controllers\Admin;

use App\Club;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index()
    {
        return view('admin.clubs.index');
    }

    public function show(Club $club)
    {
        return view('admin.clubs.show')->withClub($club);
    }

    public function create()
    {
        return $this->show(new Club);
    }

}
