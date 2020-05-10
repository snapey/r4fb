<?php

namespace App\Http\Livewire\Contacts;

use App\Contact;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class ContactTable extends TableComponent
{
    public $table_class = '';
    public $thead_class = 'text-left';
    public $checkbox = false;
    public $clickable_row = true;
    public $header_view = 'admin.contacts._header';

    public function query()
    {
        return Contact::query();
    }

    public function mount()
    {
        $this->setTableProperties();
        $this->sort_attribute = 'surname';
        $this->sort_direction = 'asc';
    }

    public function rowClick($id)
    {
        return redirect(route('admin.contacts.show', $id));
    }

    public function columns()
    {
        return [
            Column::make('Surname','surname')->searchable()->sortable(),
            Column::make('Forenames','forenames'),
            Column::make('Phone','phone1'),
            Column::make('Email','email1'),
        ];
    }
}
