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
        <label class="flex-1 inline-block w-3/12 pl-3 text-sm font-bold" for="name">Location:</label>
        <input
            class="inline-block w-8/12 px-2 py-1 mr-4 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
            wire:model.lazy="location" name="location" type="text" @if(!$editing) disabled @endif />
        @if($editing && is_null($foodbank_id))
        <button wire:click="next" tabindex="99"
            class="w-1/12 py-2 mx-auto text-sm font-bold text-center text-white bg-teal-600 border border-gray-400 rounded hover:bg-teal-700">Next</button>
        @else
        <div class="w-1/12"></div>
        @endif
    </div>
    @error('location')
    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
    @enderror

    <div class="flex flex-row items-center">
        <label class="flex-1 inline-block w-3/12 pl-3 text-sm font-bold" for="name">Organisation:</label>
        <input
            class="inline-block w-8/12 px-2 py-1 mr-4 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
            wire:model.lazy="organisation" name="organisation" type="text" @if(!$editing) disabled @endif />
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
    @error('organisation')
    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
    @enderror

    <div class="flex flex-row items-center">
        <label class="flex-1 inline-block w-3/12 pl-3 text-sm font-bold" for="name2">Alt Name:</label>
        <input
            class="inline-block w-8/12 px-2 py-1 mr-4 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
            wire:model.lazy="name2" name="name2" type="text" @if(!$editing) disabled @endif />
        <div class="w-1/12"></div>
    </div>
    @error('name2')
    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
    @enderror

    <div class="flex flex-row items-center">
        <label class="flex-1 inline-block w-3/12 pl-3 text-sm font-bold" for="name">Website:</label>
        <input
            class="inline-block w-8/12 px-2 py-1 mr-4 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
            wire:model.lazy="website" name="website" type="text" @if(!$editing) disabled @endif />
        <div class="w-1/12"></div>
    </div>
    @error('website')
    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
    @enderror
    
    <div class="flex flex-row items-center">
        <label class="flex-1 inline-block w-3/12 pl-3 text-sm font-bold" for="name">Email:</label>
        <input
            class="inline-block w-8/12 px-2 py-1 mr-4 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
            wire:model.lazy="email" name="email" type="text" @if(!$editing) disabled @endif />
        <div class="w-1/12"></div>
    </div>
    @error('email')
    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
    @enderror

    <div class="flex flex-row items-center">
        <label class="flex-1 inline-block w-3/12 pl-3 text-sm font-bold" for="name">Phone:</label>
        <input
            class="inline-block w-4/12 px-2 py-1 mr-4 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
            wire:model.lazy="phone1" name="phone1" type="text" @if(!$editing) disabled @endif />
        <div class="w-5/12"></div>
    </div>
    @error('phone1')
    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
    @enderror

    <div class="flex flex-row items-center">
        <label class="flex-1 inline-block w-3/12 pl-3 text-sm font-bold" for="name">Facebook:</label>
        <input
            class="inline-block w-8/12 px-2 py-1 mr-4 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
            wire:model.lazy="facebook" name="facebook" type="text" @if(!$editing) disabled @endif />
        <div class="w-1/12"></div>
    </div>
    @error('facebook')
    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
    @enderror

    <div class="flex flex-row items-center">
        <label class="flex-1 inline-block w-3/12 pl-3 text-sm font-bold" for="name">Charity No.:</label>
        <input
            class="inline-block w-3/12 px-2 py-1 mr-4 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
            wire:model.lazy="charity" name="charity" type="text" @if(!$editing) disabled @endif />
        <div class="w-6/12"></div>
    </div>
    @error('charity')
    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
    @enderror

    <div class="flex flex-row items-center">
        <label class="flex-1 inline-block w-3/12 pl-3 text-sm font-bold" for="name">Open Hours:</label>
        <input
            class="inline-block w-8/12 px-2 py-1 mr-4 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
            wire:model.lazy="hours" name="hours" type="text" @if(!$editing) disabled @endif />
        <div class="w-1/12"></div>
    </div>
    @error('hours')
    <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
    @enderror
</div>