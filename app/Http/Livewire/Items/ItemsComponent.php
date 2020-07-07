<?php

namespace App\Http\Livewire\Items;

use App\Item;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ItemsComponent extends Component
{
    public $item_id;
    public $code;
    public $sku;
    public $uom;
    public $weight;
    public $description;
    public $durability;
    public $generic;
    public $pounds;

    public $editing;
    public $confirming;
    public $modelName;

    protected $listeners = [
    ];

    public function mount($item)
    {
        $this->item_id = $item->id;

        $this->modelName = get_class($item);

        if (is_null($item->id)) {
            $this->editing = true;
            $this->setAttr(new item());
        }
    }

    public function render()
    {
        if ($this->redirectTo) {
            return view('admin.items.livewire.items-component')->withitem(new Item());
        }

        if (is_null($this->item_id)) {
            $item = new Item;
        } else {
            $item = Item::with(['notes.user'])->find($this->item_id);
        }

        if (!$this->editing) {
            $this->setAttr($item);
        }

        return view('admin.items.livewire.items-component')->withItem($item);
    }

    public function setAttr($item)
    {
        $this->code = $item->code;
        $this->sku = $item->sku;
        $this->uom = $item->uom;
        $this->weight = $item->weight;
        $this->description = $item->description;
        $this->durability = $item->durability;
        $this->generic = $item->generic ?? 0;
        $this->pounds = $item->pounds;
    }

    public function editMode()
    {
        $this->editing = true;
        $this->confirming = false;
    }


    public function updated($name, $value)
    {
        $this->$name = trim($value);        // ensures all inputs are trimmed
    }

    public function save()
    {

        $item = $this->persist();

        if (is_null($this->item_id)) {
            $this->redirect(route('admin.items.show', $item));
        }

        $this->editing = false;
    }

    public function next()
    {
        $this->persist();
        $this->editing = false;
        $this->redirect(route('admin.items.create'));
    }
    
    public function persist()
    {
        $data = $this->validate([
            'code' =>   [
                            'required',
                            Rule::unique('items')->ignore($this->item_id)
                        ],
            'sku' => 'max:30',
            'uom' => 'max:10',
            'weight' => 'nullable|numeric',
            'description' => 'required|max:100',
            'durability' => 'max:20',
            'generic' => 'boolean',
            'pounds' => 'required|numeric'
            ]);

        $item = is_null($this->item_id)
            ? new Item()
            : Item::find($this->item_id);

        $item->fill($data);
        $item->save();

        return $item;
    }

    public function confirmDelete()
    {
        $this->confirming = true;
    }

    public function kill()
    {
        Item::find($this->item_id)->delete();

        $this->redirect(route('admin.items.index'));
    }

}
