<?php

namespace App\Http\Livewire\Suppliers;

use App\Supplier;
use Livewire\Component;

class SupplierComponent extends Component
{
    public $supplier_id;
    public $attr;
    public $editing;
    public $confirming;
    public $modelName;

    public $name;
    public $account;
    public $phone;
    public $fax;

    protected $listeners = [
        'noteAdded' => 'redo',
        'contactsUpdated' =>  'redo',
        'contactDetached' => 'redo',
    ];

    public function mount($supplier)
    {
        $this->supplier_id = $supplier->id;

        $this->modelName = get_class($supplier);

        if (is_null($supplier->id)) {
            $this->editing = true;
            $this->setAttr(new supplier());
        }
    }


    public function redo()
    {
    }

    public function render()
    {
        if ($this->redirectTo) {
            return view('admin.suppliers.livewire.supplier-component')->withSupplier(new Supplier());
        }

        if (is_null($this->supplier_id)) {
            $supplier = new Supplier;
        } else {
            $supplier = Supplier::with(['contacts', 'notes.user'])->find($this->supplier_id);
        }

        if (!$this->editing) {
            $this->setAttr($supplier);
        }

        return view('admin.suppliers.livewire.supplier-component')
            ->withSupplier($supplier);

    }

    public function setAttr($supplier)
    {
        $this->name = $supplier->name;
        $this->account = $supplier->account;
        $this->phone = $supplier->phone;
        $this->fax = $supplier->fax;
    }

    public function editMode()
    {
        $this->editing = true;
        $this->confirming = false;
    }

    public function save()
    {

        $supplier = $this->persist();

        if (is_null($this->supplier_id)) {
            $this->redirect(route('admin.suppliers.show', $supplier));
        }

        $this->editing = false;
    }

    public function persist()
    {
        $data = $this->validate([
            'name' => 'required|max:50',
            'account' => 'max:20',
            'phone' => 'max:20',
            'fax' => 'max:20',
        ]);

        return supplier::updateOrCreate(['id' => $this->supplier_id], $data);
    }

    public function confirmDelete()
    {
        $this->confirming = true;
    }

    public function kill()
    {
        $supplier = Supplier::find($this->supplier_id);
        $supplier->contacts()->detach();
        $supplier->addresses()->delete();
        $supplier->delete();

        $this->redirect(route('admin.suppliers.index'));
    }

}
