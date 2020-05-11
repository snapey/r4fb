<div class="flex flex-col py-4 pr-4 m-4 space-y-2 bg-white border border-gray-300 rounded">


    <div class="flex flex-row items-center">
        <label class="flex-1 inline-block w-3/12 pl-3 text-sm font-bold" for="name">Name:</label>
        <input
            class="inline-block w-8/12 px-2 py-1 mr-4 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
            wire:model="name" name="name" type="text" @if(!$editing) disabled @endif />

        @if($editing)
        <button wire:click="save" tabindex="99"
            class="w-1/12 py-2 mx-auto text-xs font-bold text-center text-white bg-teal-600 border border-gray-400 rounded hover:bg-teal-700">Save</button>
        @else
        <button wire:click="editMode"
            class="w-1/12 py-2 mx-auto text-xs text-center text-gray-700 border border-gray-400 rounded">Edit</button>
        @endif
    </div>
    @error('name')
    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
    @enderror


    <div class="flex flex-row items-center">
        <label class="flex-1 inline-block w-3/12 pl-3 text-sm font-bold" for="name">Areas:</label>
        <input
            class="inline-block w-8/12 px-2 py-1 mr-4 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
            wire:model.lazy="areas" name="areas" type="text" @if(!$editing) disabled @endif />
        @if($editing && is_null($club_id))
        <button wire:click="next" tabindex="99"
            class="w-1/12 py-2 mx-auto text-sm font-bold text-center text-white bg-teal-600 border border-gray-400 rounded hover:bg-teal-700">Next</button>
        @else
        <div class="w-1/12"></div>
        @endif
    </div>
    @error('areas')
    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
    @enderror


    <div class="flex flex-row items-center">
        <label class="flex-1 inline-block w-3/12 pl-3 text-sm font-bold" for="name">District:</label>
        <input
            class="inline-block w-2/12 px-2 py-1 mr-4 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
            wire:model.lazy="district" name="district" type="text" @if(!$editing) disabled @endif />
        <div class="w-6/12"></div>
        @if(!$editing)
            @if($confirming)
            <button wire:click="kill()"
                class="w-1/12 py-2 mx-auto text-xs text-center text-white bg-red-800 border rounded hover:bg-red-600">Sure?</button>
            @else
            <button wire:click="confirmDelete()"
                class="w-1/12 py-2 mx-auto text-xs text-center text-gray-700 border border-gray-400 rounded hover:bg-red-800 hover:text-white">Delete</button>
            @endif
        @else
        <div class="w-1/12"></div>
        @endif
    </div>
    @error('district')
    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
    @enderror

    <div class="flex flex-row items-center">
        <label class="flex-1 inline-block w-3/12 pl-3 text-sm font-bold" for="name">Group:</label>
        <input
            class="inline-block w-8/12 px-2 py-1 mr-4 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
            wire:model.lazy="group" name="group" type="text" @if(!$editing) disabled @endif />
        <div class="w-1/12"></div>
    </div>
    @error('group')
    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
    @enderror

</div>