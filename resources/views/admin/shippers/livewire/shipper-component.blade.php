<div class="bg-gray-200">

    <div class="flex flex-row items-center justify-between pt-2 mx-4 my-2">
        <h2 class="text-xl font-bold text-teal-800 ">SHIPPER</h2>
        <a href="{{ route('admin.shippers.index')}}" class="px-4 py-1 text-sm bg-gray-100 border rounded hover:bg-gray-300">Return to Index</a>
    </div>

    <div class="flex flex-row border-t-2 border-gray-400" wire:poll.20s>

        <div class="w-3/4 my-4 border-r-2 border-gray-400">
            <h2 class="mx-4 text-xl font-bold ">{{ $name }}</h2>

            <div class="flex flex-row">
                <div class="flex flex-col w-11/12 py-4 pl-4 pr-4 m-4 space-y-2 bg-white border border-gray-300 rounded">

                    <x-inputs.text-editable editing="{{ $editing }}" name="name" label="Name:" />
                    <x-inputs.text-editable editing="{{ $editing }}" name="modes" label="Modes:" />
                    <x-inputs.text-editable editing="{{ $editing }}" name="phone" label="Phone:" half />
                    <x-inputs.checkbox-editable editing="{{ $editing }}" name="is_satellite" label="Is Satellite?" checked="{{$is_satellite}}"  />
                </div>

                {{-- Controls --}}
                <div class="w-1/12 mt-8 mr-4 space-y-1">
                    @if($editing)
                        <x-button wire:click="save" class="w-full" active>Save</x-button>
                    @else
                        <x-button wire:click="editMode" class="w-full">Edit</x-button>
                    @endif

                    @if($editing && is_null($shipper_id))
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

            @if($shipper->id)
                @livewire('address-component',['addressable' => $shipper ])
                @livewire('notes-component',['notable' => $shipper ])
            @endif

        </div>

        <div class="w-1/4">
            @foreach($shipper->contacts as $contact)
                @livewire('contacts.contact-card', ['contact' => $contact], key($contact->id))
            @endforeach
            @livewire('contacts.newcontact', ['model' => $shipper] )
        </div>

    </div>

    <script>
        function removeClass(el,theclass,delay) {
            setTimeout(() => {
                el.classList.remove(theclass);
            }, delay);
        }
    </script>

</div>