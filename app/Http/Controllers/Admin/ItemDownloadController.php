<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CatalogExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ItemDownloadController extends Controller
{

    public function download($filter)
    {
        return Excel::download(new CatalogExport($filter), 'R4FBItems.' . today()->format('Ymd') . '.xlsx');
    }
}
