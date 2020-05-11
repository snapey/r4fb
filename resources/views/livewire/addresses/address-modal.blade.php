<div>
    <div class="fixed top-0 left-0 z-20 flex items-center justify-center w-full h-full modal">
        <div class="absolute w-full h-full bg-gray-900 opacity-50 pointer-events-none modal-overlay"></div>

        <div class="z-50 w-11/12 mx-auto overflow-y-auto bg-white rounded shadow-lg modal-container md:max-w-md">

            <div
                class="absolute top-0 right-0 z-50 flex flex-col items-center mt-4 mr-4 text-sm text-white cursor-pointer">
                <a href="#" wire:click.prevent="closeAddressModal()">
                    <svg class="text-white fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </a>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="px-4 py-4 text-left modal-content">
                <!--Title-->
                <div class="flex items-center justify-between pb-3">
                    <p class="text-2xl font-bold">Address</p>
                    <div class="z-50 modal-close">
                        <a href="#" wire:click.prevent="closeAddressModal()">
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
                    <div class="flex flex-row items-center">
                        <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="address1">Address 1:</label>
                        <input {{ !$editing ? 'disabled': '' }}
                            class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                            wire:model.lazy="address1" name="address1" type="text" />
                    </div>
                    @error('address1')
                    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                    @enderror

                    <div class="flex flex-row items-center">
                        <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="address2">Address 2:</label>
                        <input {{ !$editing ? 'disabled': '' }}
                            class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                            wire:model.lazy="address2" name="address2" type="text" />
                    </div>
                    @error('address2')
                    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                    @enderror

                    @include('admin.contacts._candidates')

                    <div class="flex flex-row items-center">
                        <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="address3">Address 3:</label>
                        <input {{ !$editing ? 'disabled': '' }}
                            class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                            wire:model.lazy="address3" name="address3" type="text" />
                    </div>
                    @error('address3')
                    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                    @enderror

                    <div class="flex flex-row items-center">
                        <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="address4">Address 4:</label>
                        <input {{ !$editing ? 'disabled': '' }}
                            class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                            wire:model.lazy="address4" name="address4" type="text" />
                    </div>
                    @error('address4')
                    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                    @enderror

                    <div class="flex flex-row items-center">
                        <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="postcode">Postcode:</label>
                        <input {{ !$editing ? 'disabled': '' }}
                            class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                            wire:model.lazy="postcode" name="postcode" type="text" />
                    </div>
                    @error('postcode')
                    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                    @enderror

                    <div class="flex flex-row items-center">
                        <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="phone_number">Phone:</label>
                        <input {{ !$editing ? 'disabled': '' }}
                            class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                            wire:model.lazy="phone_number" name="phone_number" type="text" />
                    </div>
                    @error('phone_number')
                    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                    @enderror

                    <div class="flex flex-row items-center">
                        <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="latitude">Coordinates:</label>
                        <input {{ !$editing ? 'disabled': '' }}
                            class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                            wire:model.lazy="latitude" name="latitude" type="text" />
                    </div>
                    @error('latitude')
                    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                    @enderror


                </div>
                <!--Footer-->
                <div x-data="{ deleteMessage:false }">
                    <div class="flex justify-end mt-3 space-x-4 border-t border-gray-300">
                        @if(!is_null($address_id))
                        <button x-on:click="deleteMessage=true"
                            class="w-24 py-2 mt-4 text-xs font-bold text-center text-gray-700 border border-gray-400 rounded hover:bg-red-600 hover:text-white ">
                            Delete
                        </button>
                        @endif
                        <button wire:click.prevent="closeAddressModal()"
                            class="w-24 py-2 mt-4 text-xs font-bold text-center text-gray-700 border border-gray-400 rounded ">Cancel</button>
                        @if($editing)
                        <button wire:click="save"
                            class="w-24 py-2 mt-4 text-xs font-bold text-center text-white bg-teal-600 border border-gray-400 rounded hover:bg-teal-700">Save</button>
                        @else
                        <button wire:click="editMode"
                            class="w-24 py-2 mt-4 text-xs font-bold text-center text-gray-700 border border-gray-400 rounded">Edit</button>
                        @endif
                    </div>
                    <div x-show="deleteMessage" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-100 transform scale-y-50"
                        x-transition:enter-end="opacity-100 transform scale-y-100"
                        class="p-4 mt-4 text-sm leading-relaxed text-center text-gray-100 bg-gray-800 rounded">
                        Please confirm that you want to permanently delete this address. Yes,
                        <a href="#" wire:click.prevent="deleteAddress" class="text-yellow-300 underline hover:bg-gray-900">
                            delete this address</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>