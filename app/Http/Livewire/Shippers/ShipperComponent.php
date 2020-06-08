<?php

namespace App\Http\Livewire\Shippers;

use App\Shipper;
use Livewire\Component;

class ShipperComponent extends Component
{
    public $shipper_id;
    public $attr;
    public $editing;
    public $confirming;
    public $modelName;

    public $name;
    public $modes;
    public $phone;
    public $is_satellite;

    protected $listeners = [
        'noteAdded' => 'redo',
        'contactsUpdated' =>  'redo',
        'contactDetached' => 'redo',
    ];

    public function mount($shipper)
    {
        $this->shipper_id = $shipper->id;

        $this->modelName = get_class($shipper);

        if (is_null($shipper->id)) {
            $this->editing = true;
            $this->setAttr(new Shipper());
        }
    }


    public function redo()
    {
    }

    public function render()
    {
        if ($this->redirectTo) {
            return view('admin.shippers.livewire.shipper-component')->withShipper(new Shipper());
        }

        if (is_null($this->shipper_id)) {
            $shipper = new Shipper;
        } else {
            $shipper = Shipper::with(['contacts', 'notes.user'])->find($this->shipper_id);
        }

        if (!$this->editing) {
            $this->setAttr($shipper);
        }

        return view('admin.shippers.livewire.shipper-component')
            ->withShipper($shipper);

    }

    public function setAttr($shipper)
    {
        $this->name = $shipper->name;
        $this->modes = $shipper->modes;
        $this->phone = $shipper->phone;
        $this->is_satellite = $shipper->is_satellite;
    }

    public function editMode()
    {
        $this->editing = true;
        $this->confirming = false;
    }

    public function save()
    {

        $shipper = $this->persist();

        if (is_null($this->shipper_id)) {
            $this->redirect(route('admin.shippers.show', $shipper));
        }

        $this->editing = false;
    }

    public function persist()
    {
        $data = $this->validate([
            'name' => 'required|max:50',
            'modes' => 'max:50',
            'phone' => 'max:20',
            'is_satellite' => '',
        ]);
// dump($data);
        return Shipper::updateOrCreate(['id' => $this->shipper_id], $data);
    }

    public function confirmDelete()
    {
        $this->confirming = true;
    }

    public function kill()
    {
        $shipper = Shipper::find($this->shipper_id);
        $shipper->contacts()->detach();
        $shipper->addresses()->delete();
        $shipper->delete();

        $this->redirect(route('admin.shippers.index'));
    }

}
