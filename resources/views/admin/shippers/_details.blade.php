<div class="flex flex-row">
    <div class="flex flex-col w-11/12 py-4 pl-4 pr-4 m-4 space-y-2 bg-white border border-gray-300 rounded">

        <x-inputs.text-editable editing="{{ $editing }}" name="name" label="Name:" />
        <x-inputs.text-editable editing="{{ $editing }}" name="modes" label="Modes:" />
        <x-inputs.text-editable editing="{{ $editing }}" name="phone" label="Phone:" half />
        
    </div>

    {{-- Controls --}}
    <div class="w-1/12 mt-8 mr-4 space-y-1">
        @if($editing)
            <x-button wire:click="save" class="w-full" active >Save</x-button>
        @else
            <x-button wire:click="editMode" class="w-full" >Edit</x-button>
        @endif

        @if($editing && is_null($shipper_id))
            <x-button wire:click="next" class="w-full" active >Next</x-button>
        @else
            <div class="w-full"></div>
        @endif

        @if(!$editing)
            @if($confirming)
                <x-button wire:click="kill()" class="w-full" danger active >Sure?</x-button>
            @else
                <x-button wire:click="confirmDelete()" class="w-full" danger >Delete</x-button>
            @endif
        @endif
    </div>
</div>