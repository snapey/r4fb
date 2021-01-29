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
    
                    <x-inputs.text-editable editing="{{ $editing }}" name="surname" label="Surname:" placeholder="the contact's last name" />
                    @include('admin.contacts._candidates')
                    <x-inputs.text-editable editing="{{ $editing }}" name="forenames" label="Forenames:" />
                    <x-inputs.text-editable editing="{{ $editing }}" name="title" label="Title:" placeholder="eg, Mr, Rev., Prof., Dr" half />
                    <x-inputs.text-editable editing="{{ $editing }}" name="phone1" label="Phone:" half />
                    <x-inputs.text-editable editing="{{ $editing }}" name="phone2" label="Alt. Phone:" half />
                    <x-inputs.text-editable editing="{{ $editing }}" name="email1" label="Email:" />
                    <x-inputs.text-editable editing="{{ $editing }}" name="email2" label="Alt. Email:" />

                    <hr />
                    
                    <x-inputs.text-editable editing="{{ $editing }}" name="contactable.relationship" label="Relationship:" placeholder="What relationship to this {{$model_realname}}" />

                    <hr />
                    <x-inputs.select-editable editing="{{ $editing }}" name="researcher" label="Researcher:" :list="$researchers" :current="$researchers[$researcher] ?? ''" />

                </div>
                <!--Footer-->
                @can('Contacts.edit')
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
                @endcan
            </div>
        </div>
    </div>
</div>