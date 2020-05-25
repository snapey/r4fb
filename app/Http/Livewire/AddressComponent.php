<?php

namespace App\Http\Livewire;

use App\Address;
use Livewire\Component;

class AddressComponent extends Component
{
    public $editing;
    public $exists;
    public $modalShowing;

    public $address_id;
    public $address1;
    public $address2;
    public $address3;
    public $address4;
    public $postcode;
    public $phone_number;
    public $coordinates;
    public $addressable = [];

    public function mount($addressable)
    {
        $this->addressable = [
            'addressable_id' => $addressable->id,
            'addressable_type' => get_class($addressable),
        ];
    }

    public function render()
    {   
        $addresses = $this->addressable['addressable_type']::find($this->addressable['addressable_id'])->addresses()->get();

        return view('admin.addresses.address-component')->withAddresses($addresses);
    }

    public function showAddress($id)
    {
        $this->setAttributes(Address::find($id));
        $this->modalShowing = true;
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
        $this->coordinates  = $address->latitude . ',' . $address->longitude;
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
            'coordinates' => 'max:20',
        ]);

        $coords = explode(',', $data['coordinates']);
        $data['latitude'] = $coords[0];
        $data['longitude'] = $coords[1];

        Address::UpdateOrCreate(['id' => $this->address_id], $data + $this->addressable);

        $this->editing = false;
    }

    public function deleteAddress()
    {
        Address::find($this->address_id)->delete();
        $this->modalShowing = false;
    }

    public function newAddress()
    {
        $this->setAttributes(new Address);
        $this->modalShowing=true;
        $this->editing=true;
    }
}
