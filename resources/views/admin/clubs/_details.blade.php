<div class="flex flex-row">
    <div class="flex flex-col w-11/12 px-4 py-4 m-4 space-y-2 bg-white border border-gray-300 rounded">
        <x-inputs.text-editable editing="{{ $editing }}" name="name" label="Name:" />
        <x-inputs.text-editable editing="{{ $editing }}" name="areas" label="Areas:" />
        <x-inputs.text-editable editing="{{ $editing }}" name="district" label="District:" />
        <x-inputs.text-editable editing="{{ $editing }}" name="group" label="Group:" />
    </div>

    {{-- Buttons --}}
    @can('Clubs.edit')
        <div class="w-1/12 mt-8 mr-4 space-y-2">

            @if($editing)
                <x-button wire:click="save" class="w-full" active >Save</x-button>
            @else
                <x-button wire:click="editMode" class="w-full" >Edit</x-button>
            @endif        

            @if(!$editing)
                @if($confirming)
                    <x-button wire:click="kill()" class="w-full" danger active>Sure?</x-button>
                @else
                    <x-button wire:click="confirmDelete()" class="w-full" danger >Delete</x-button>
                @endif
            @endif
            
        </div>
    @endcan
</div>
