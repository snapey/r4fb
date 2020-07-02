<?php

namespace App\Http\Controllers\Admin;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index()
    {
        return view('admin.items.index');
    }

    public function create()
    {
        return $this->show(new Item);
    }

    public function show(Item $item)
    {
        $item->load('notes');
        return view('admin.items.show')->withItem($item);
    }
}
