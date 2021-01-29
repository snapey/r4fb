<div>
    <div class="fixed top-0 left-0 z-20 flex items-center justify-center w-full h-full modal">
        <div class="absolute w-full h-full bg-gray-900 opacity-50 pointer-events-none modal-overlay"></div>

        <div class="z-50 w-11/12 mx-auto overflow-y-auto bg-white rounded shadow-lg modal-container md:max-w-md">

            <div
                class="absolute top-0 right-0 z-50 flex flex-col items-center mt-4 mr-4 text-sm text-white cursor-pointer">
                <a href="#" wire:click.prevent="$set('modalShowing',false)">
                    <svg class="text-white fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </a>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="px-4 py-4 text-left modal-content" x-data x-on:keydown.escape="window.livewire.emit('close')">
                <!--Title-->
                <div class="flex items-center justify-between pb-3">
                    <p class="text-2xl font-bold">Address</p>
                    <div class="z-50 modal-close">
                        <a href="#" wire:click.prevent="$set('modalShowing',false)">
                            <svg class="text-black fill-current" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!--Body-->
                <div class="flex flex-col space-y-3">

                    <x-inputs.text-editable editing="{{ $editing }}" name="address1" label="Address 1:" placeholder="required" />
                    <x-inputs.text-editable editing="{{ $editing }}" name="address2" label="Address 2:" />
                    <x-inputs.text-editable editing="{{ $editing }}" name="address3" label="Address 3:" />
                    <x-inputs.text-editable editing="{{ $editing }}" name="address4" label="Address 4:" />
                    <x-inputs.text-editable editing="{{ $editing }}" name="postcode" label="Postcode:" placeholder="required" />
                    <x-inputs.text-editable editing="{{ $editing }}" name="phone_number" label="Phone:" />
                    <x-inputs.text-editable editing="{{ $editing }}" name="coordinates" label="Coordinates:" placeholder="latitude, longitude" />

                </div>
                <!--Footer-->
                @can('Addresses.edit')
                    <div x-data="{ deleteMessage:false }">
                        <div class="flex justify-end mt-3 space-x-4 border-t border-gray-300">
                            @if(!is_null($address_id))
                            <x-button x-on:click="deleteMessage=true" class="w-24 mt-4" danger>Delete</x-button>
                            @endif
                            <x-button wire:click.prevent="$set('modalShowing',false)" class="w-24 mt-4 ">Cancel</x-button>
                            @if($editing)
                                <x-button wire:click="save" class="w-24 mt-4" active >Save</x-button>
                            @else
                                <x-button wire:click="editMode" class="w-24 mt-4" >Edit</x-button>
                            @endif
                        </div>
                        <div x-show="deleteMessage" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-100 transform scale-y-50"
                            x-transition:enter-end="opacity-100 transform scale-y-100"
                            class="p-4 mt-4 text-sm leading-relaxed text-center text-gray-100 bg-gray-800 rounded">
                            Please confirm that you want to permanently delete this address. Yes,
                            <a href="#" wire:click.prevent="deleteAddress"
                                class="text-yellow-300 underline hover:bg-gray-900">
                                delete this address</a>
                        </div>
                    </div>
                @else
                    <div class="py-2 mx-auto my-2 italic text-center text-gray-500 border-t">Insufficient rights to edit</div>
                @endcan
            </div>
        </div>
    </div>
</div>