<div class="bg-gray-200">

    <div class="flex flex-row items-center justify-between pt-2 mx-4 my-2">
    <h2 class="text-xl font-bold text-teal-800 ">Allocation {{ $allocation_id }}</h2>
        <a href="{{ route('allocations.index')}}"
            class="px-4 py-1 text-sm bg-gray-100 border rounded hover:bg-gray-300">Return to Index</a>
    </div>

    <div class="flex flex-row border-t-2 border-gray-400" wire:poll.20s>

        <div class="w-3/4 my-4 border-r-2 border-gray-400">

            <div class="flex flex-row">
                <div class="flex flex-col w-11/12 py-4 pl-4 pr-4 m-4 space-y-2 bg-white border border-gray-300 rounded">

                    <x-inputs.text-editable name="status" label="Status:" half />
                    <div class="flex flex-row items-center">
                        <span class="block w-3/12 text-sm font-bold">Foodbank:</span>
                        <span class="inline-block w-4/12 px-2 py-2 bg-gray-200 rounded">{{ $foodbank }}</span>
                        @if($editing)
                            <x-button wire:click="$set('showFoodbankPicker',true)" class="w-2/12 ml-8">Change Foodbank</x-button>
                        @endif
                    </div>
                    <x-inputs.text-editable editing="{{ $editing }}" name="budget" label="Budget: (£)" half />
                    <x-inputs.text-editable name="created_by" label="Created By:" half />
                </div>

                {{-- Controls --}}
                <div class="w-1/12 mt-8 mr-4 space-y-1">
                    @if($editing)
                    <x-button wire:click="save" class="w-full" active>Save</x-button>
                    @else
                    <x-button wire:click="editMode" class="w-full">Edit</x-button>
                    @endif

                    @if($editing && is_null($allocation->id))
                    <x-button wire:click="next" class="w-full" active>Next</x-button>
                    @else
                    <div class="w-full"></div>
                    @endif

                    @if(!$editing)
                    @if($confirming)
                    <x-button wire:click="kill()" class="w-full" danger active>Sure?</x-button>
                    @else
                    <x-button wire:click="confirmDelete()" class="w-full" danger>Delete</x-button>
                    @endif
                    @endif
                </div>
            </div>

            @if($allocation_id)
                @livewire('allocations.allocation-stock', ['allocation' => $allocation])
                @livewire('notes-component',['notable' => $allocation ])
            @endif

        </div>

    </div>

    @if($showFoodbankPicker)
        @include('admin.clubs.foodbank-modal')
    @endif

    <script>
        function removeClass(el,theclass,delay) {
            setTimeout(() => {
                el.classList.remove(theclass);
            }, delay);
        }
    </script>

</div>