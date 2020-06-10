<?php

namespace App\Http\Livewire\Easycopy;

use Livewire\Component;

class Foodbank extends Component
{
    public $foodbank;

    protected $listeners = [
        'addressesVaried' => 'redo',
        'contactDetached' => 'redo',
        'contactsUpdated' => 'redo',
    ];

    public function redo(){}

    public function mount($foodbank)
    {
        $this->foodbank = $foodbank;
    }

    public function render()
    {
        $this->foodbank->load('addresses', 'contacts', 'clubs');

        return view('livewire.easycopy.foodbank');
    }
}
