<!--Modal-->
<div
    class="fixed top-0 left-0 z-20 flex items-center justify-center w-full h-full modal">
    <div class="absolute w-full h-full bg-gray-900 opacity-50 modal-overlay"></div>

    <div class="z-50 w-11/12 mx-auto overflow-y-auto bg-white rounded shadow-lg modal-container md:max-w-md">

        <div
            class="absolute top-0 right-0 z-50 flex flex-col items-center mt-4 mr-4 text-sm text-white cursor-pointer modal-close">
            <svg class="text-white fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                viewBox="0 0 18 18">
                <path
                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                </path>
            </svg>
        </div>

        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="px-4 py-4 text-left modal-content">
            <!--Title-->
            <div class="flex items-center justify-between pb-3">
                <p class="text-2xl font-bold">Add a new contact</p>
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
                    <input
                        class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                        wire:model="forenames" name="forenames" type="text" />
                </div>
                @error('forenames')
                <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                @enderror

                <div class="flex flex-row items-center">
                    <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="surname">Surname:</label>
                    <input
                        class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                        wire:model="surname" name="surname" type="text" />
                </div>
                @error('surname')
                <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                @enderror

                <div class="flex flex-row items-center">
                    <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="phone1">Phone:</label>
                    <input
                        class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                        wire:model="phone1" name="phone1" type="text" />
                </div>
                @error('phone1')
                <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                @enderror

                <div class="flex flex-row items-center">
                    <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="phone2">Alt. Phone:</label>
                    <input
                        class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                        wire:model="phone2" name="phone2" type="text" />
                </div>
                @error('phone2')
                <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                @enderror

                <div class="flex flex-row items-center">
                    <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="email1">Email:</label>
                    <input
                        class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                        wire:model="email1" name="email1" type="text" />
                </div>
                @error('email1')
                <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                @enderror

                <div class="flex flex-row items-center">
                    <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="email2">Alt. Email:</label>
                    <input
                        class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                        wire:model="email2" name="email2" type="text" />
                </div>
                @error('email2')
                <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                @enderror

                <div class="flex flex-row items-center">
                    <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="relationship">Relationship:</label>
                    <input placeholder="What is the relationship"
                        class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                        wire:model="relationship" name="relationship" type="text" />
                </div>
                @error('relationship')
                <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
                @enderror

                
            </div>
            <!--Footer-->
            <div class="flex justify-end mt-3 space-x-4 border-t border-gray-300">
                <button wire:click.prevent="close()"
                    class="w-24 py-2 mt-4 text-xs font-bold text-center text-gray-700 border border-gray-400 rounded ">Cancel</button>
                @if($editing)
                <button wire:click="save"
                    class="w-24 py-2 mt-4 text-xs font-bold text-center text-white bg-teal-600 border border-gray-400 rounded hover:bg-teal-700">Save</button>
                @else
                <button wire:click="editMode"
                    class="w-24 py-2 mt-4 text-xs text-center text-gray-700 border border-gray-400 rounded">Edit</button>
                @endif
            </div>

        </div>
    </div>
</div>

