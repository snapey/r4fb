<div class="flex flex-row">
    <div class="flex flex-col w-11/12 px-4 py-4 m-4 space-y-2 bg-white border border-gray-300 rounded">
    
        <x-inputs.text-editable editing="{{ $editing }}" name="name" label="Name:" />
        <x-inputs.text-editable editing="{{ $editing }}" name="location" label="Location:" />
        <x-inputs.text-editable editing="{{ $editing }}" name="organisation" label="Organisation:" />
        <x-inputs.text-editable editing="{{ $editing }}" name="name2" label="Alt. Name:" />
        <x-inputs.text-editable editing="{{ $editing }}" name="phone1" label="Phone1:" half />
        <x-inputs.text-editable editing="{{ $editing }}" name="phone2" label="Phone2:" half />
        <x-inputs.text-editable editing="{{ $editing }}" name="email" label="Email:" />
        <x-inputs.text-editable editing="{{ $editing }}" name="website" label="Website:" />
        <x-inputs.text-editable editing="{{ $editing }}" name="facebook" label="Facebook:" />
        <x-inputs.text-editable editing="{{ $editing }}" name="charity" label="Charity No:" half />
        <x-inputs.text-editable editing="{{ $editing }}" name="hours" label="Open Hours:" />
        <x-inputs.select-editable editing="{{ auth()->user()->can('Foodbanks.approve') ? $editing : 0 }}" name="status" label="Approval state:" :list="$foodbank->foodbankStatuses()" :current="$foodbank->foodbankStatus() ?? '' " />
        <x-inputs.select-editable editing="{{ $editing }}" name="shipper_id" label="Shipped Via:" :list="$shippers" :current="$foodbank->shipper->name ?? '' " />
    
    </div>

    @can('Foodbanks.edit')
        <div class="w-1/12 mt-8 mr-4 space-y-2">
            @if($editing)
                <x-button wire:click="save" class="w-full" active >Save</x-button>
            @else
                <x-button wire:click="editMode" class="w-full">Edit</x-button>
            @endif

            @if(!$editing)
                @if($confirming)
                    <x-button wire:click="kill()" class="w-full" danger active >Sure?</x-button>
                @else
                    <x-button wire:click="confirmDelete()" class="w-full" danger>Delete</x-button>
                @endif
            @endif
        </div>
    @endcan
</div>

