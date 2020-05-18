<?php

namespace App\Http\Livewire\Addresses;

use App\Address;
use Livewire\Component;

class AddressModal extends Component
{    
    public $editing;
    public $exists;

    public $address_id;
    public $address1;
    public $address2;
    public $address3;
    public $address4;
    public $postcode;
    public $phone_number;
    public $latitude;
    public $longitude;
    public $addressable =[];

    public function mount($address, $addressable)
    {
        if($address){
            $this->setAttributes($address);
        } else {
            $this->editing=true;
        }

        $this->addressable = [
            'addressable_id' => $addressable->id,
            'addressable_type' => get_class($addressable)
        ];
    }

    public function render()
    {
        return view('livewire.addresses.address-modal');
    }

    public function setAttributes($address)
    {
        $this->address_id   = $address->id;
        $this->address1     = $address->address1;
        $this->address2     = $address->address2;
        $this->address3     = $address->address3;
        $this->address4     = $address->address4;
        $this->postcode     = $address->postcode;
        $this->phone_number = $address->phone_number;
        $this->latitude     = $address->latitude;
        $this->longitude    = $address->longitude;

    }

    public function editMode()
    {
        $this->editing = true;
    }

    public function closeAddressModal()
    {
        $this->emit('closeAddressModal');
    }

    public function save()
    {
        $data = $this->validate([
            'address1' => 'required | max:200',
            'address2' => 'max:200',
            'address3' => 'max:200',
            'address4' => 'max:200',
            'postcode' => 'required | max:200',
            'phone_number' => 'max:20',
            'latitude' => 'max:12',
            'longitude' => 'max:12',
        ]);

        $address = Address::UpdateOrCreate(['id'=>$this->address_id],$data + $this->addressable);

        $this->editing=false;
    }

    public function deleteAddress()
    {
        Address::find($this->address_id)->delete();
        $this->emit('closeAddressModal');

    }
}
