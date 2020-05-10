<div>
    <div class="fixed top-0 left-0 z-20 flex items-center justify-center w-full h-full modal">
        <div class="absolute w-full h-full bg-gray-900 opacity-50 pointer-events-none modal-overlay"></div>
    
        <div class="z-50 w-11/12 mx-auto overflow-y-auto bg-white rounded shadow-lg modal-container md:max-w-md">
    
            <div
                class="absolute top-0 right-0 z-50 flex flex-col items-center mt-4 mr-4 text-sm text-white cursor-pointer">
                <a href="#" wire:click.prevent="close()" >
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
                    <p class="text-2xl font-bold">Contact</p>
                    <div class="z-50 modal-close">
                        <a href="#" wire:click.prevent="close()">
                            <svg class="text-black fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 18 18">
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
                        <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="fornames">Forenames:</label>
                        <input {{ !$editing ? 'disabled': '' }}
                            class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                            wire:model.lazy="forenames" name="forenames" type="text" />
                    </div>
                    @error('forenames')
                    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                    @enderror
    
                    <div class="flex flex-row items-center">
                        <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="surname">Surname:</label>
                        <input {{ !$editing ? 'disabled': '' }}
                            class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                            wire:model.lazy="surname" name="surname" type="text" />
                    </div>
                    @error('surname')
                    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                    @enderror

                    @include('admin.contacts._candidates')
    
                    <div class="flex flex-row items-center">
                        <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="phone1">Phone:</label>
                        <input {{ !$editing ? 'disabled': '' }}
                            class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                            wire:model.lazy="phone1" name="phone1" type="text" />
                    </div>
                    @error('phone1')
                    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                    @enderror
    
                    <div class="flex flex-row items-center">
                        <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="phone2">Alt. Phone:</label>
                        <input {{ !$editing ? 'disabled': '' }}
                            class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                            wire:model.lazy="phone2" name="phone2" type="text" />
                    </div>
                    @error('phone2')
                    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                    @enderror
    
                    <div class="flex flex-row items-center">
                        <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="email1">Email:</label>
                        <input {{ !$editing ? 'disabled': '' }}
                            class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                            wire:model.lazy="email1" name="email1" type="text" />
                    </div>
                    @error('email1')
                    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                    @enderror
    
                    <div class="flex flex-row items-center">
                        <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="email2">Alt. Email:</label>
                        <input {{ !$editing ? 'disabled': '' }}
                            class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                            wire:model.lazy="email2" name="email2" type="text" />
                    </div>
                    @error('email2')
                    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                    @enderror
    
                    <div class="flex flex-row items-center">
                        <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="relationship">Relationship:</label>
                        <input {{ !$editing ? 'disabled': '' }} placeholder="What is the relationship"
                            class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                            wire:model.lazy="contactable.relationship" name="relationship" type="text" />
                    </div>
                    @error('relationship')
                    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                    @enderror
    
    
                </div>
                <!--Footer-->
                <div  x-data="{ deleteMessage:false }">
                    <div class="flex justify-end mt-3 space-x-4 border-t border-gray-300">
                        @if($exists)
                            <button x-on:click="deleteMessage=true"
                                class="w-24 py-2 mt-4 text-xs font-bold text-center text-gray-700 border border-gray-400 rounded hover:bg-red-600 hover:text-white ">
                                Delete
                            </button>
                        @endif
                        <button wire:click.prevent="close()"
                            class="w-24 py-2 mt-4 text-xs font-bold text-center text-gray-700 border border-gray-400 rounded ">Cancel</button>
                        @if($editing)
                        <button wire:click="save"
                            class="w-24 py-2 mt-4 text-xs font-bold text-center text-white bg-teal-600 border border-gray-400 rounded hover:bg-teal-700">Save</button>
                        @else
                        <button wire:click="editMode"
                            class="w-24 py-2 mt-4 text-xs font-bold text-center text-gray-700 border border-gray-400 rounded">Edit</button>
                        @endif
                    </div>
                    <div    x-show="deleteMessage" 
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-100 transform scale-y-50"
                            x-transition:enter-end="opacity-100 transform scale-y-100"
                            class="p-4 mt-4 text-sm leading-relaxed text-center text-gray-100 bg-gray-800 rounded">
                                Pressing delete only removes the Contact's association with this {{ $contactable['contactable_type']::NAME }}. To remove the contact completely, visit the 
                                Contacts admin area. 
                        <a href="#" 
                            wire:click.prevent="detachContact" 
                            class="text-yellow-300 underline hover:bg-gray-900">
                            Detach this contact</a>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>