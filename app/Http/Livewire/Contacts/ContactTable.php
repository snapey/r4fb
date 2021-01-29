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
        return Contact::query()->myContacts();
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
            Column::make('Alt.Phone','phone2'),
            Column::make('Email','email1'),
        ];
    }

    public function tdPresenter($attribute, $value)
    {
        return $value;
    }

    public function thClass($attribute)
    {
        if ($attribute == 'surname') return 'w-2/12';
        if ($attribute == 'forenames') return 'w-2/12';
        if ($attribute == 'phone1') return 'w-2/12';
        if ($attribute == 'phone2') return 'w-2/12';
        if ($attribute == 'email1') return 'w-4/12';

        return null;
    }

    public function tdClass($attribute, $value)
    {
        if ($attribute == 'surname') return 'w-2/12';
        if ($attribute == 'forenames') return 'w-2/12';
        if ($attribute == 'phone1') return 'w-2/12';
        if ($attribute == 'phone2') return 'w-2/12';
        if ($attribute == 'email1') return 'w-4/12 overflow-hidden';

        return null;
    }
}
