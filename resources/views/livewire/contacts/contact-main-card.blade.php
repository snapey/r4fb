<div wire:poll.20s class="bg-gray-200">

    <div class="flex flex-row items-center justify-between pt-2 mx-4 my-2">
        <h2 class="text-xl font-bold text-teal-800 ">CONTACT</h2>
        <a href="{{ route('admin.contacts.index')}}" class="px-4 py-1 text-sm bg-gray-100 border rounded hover:bg-gray-300">Return to Index</a>
    </div>

    <div class="flex flex-row border-t-2 border-gray-400">

        <div class="w-3/4 my-4 border-r-2 border-gray-400">
            <h2 class="mx-4 text-xl font-bold">{{ $forenames }} {{ $surname}}</h2>

            {{-- fields --}}
            <div class="flex flex-col w-full">
                <div class="p-4 mx-4 my-2 space-y-3 bg-white border rounded ">

                    <x-inputs.text-editable editing="{{ $editing }}" name="surname" label="Surname:" placeholder="the contact's last name" />
                    <x-inputs.text-editable editing="{{ $editing }}" name="forenames" label="Forenames:" />
                    <x-inputs.text-editable editing="{{ $editing }}" name="title" label="Title:" placeholder="eg, Mr, Rev., Prof., Dr" half/>
                    <x-inputs.text-editable editing="{{ $editing }}" name="phone1" label="Phone:" half />
                    <x-inputs.text-editable editing="{{ $editing }}" name="phone2" label="Alt. Phone:" half />
                    <x-inputs.text-editable editing="{{ $editing }}" name="email1" label="Email:" />
                    <x-inputs.text-editable editing="{{ $editing }}" name="email2" label="Alt. Email:" />

                </div>
            </div>

            {{-- relationships ---------------------------------------------------- --}}
            @include('livewire.contacts._relationships')
            
            {{-- notes ---------------------------------------------------- --}}
            @livewire('notes-component',['notable' => $contact ])
            
        </div>
        {{-- controls ------------------------------------------------- --}}

        <div class="w-3/12 mt-8 text-center">
            <div class="flex flex-col px-4 mt-4 space-y-3">

                @if($editing)
                    <x-button wire:click="save" class="w-24" active >Save</x-button>
                @else
                    <x-button wire:click="editMode" class="w-24">Edit</x-button>
                @endif

                <x-button wire:click="cancel" class="w-24">Cancel</x-button>
                    
                @if($exists)
                    @if($confirming)
                        <x-button wire:click="kill" class="w-24" danger active>You Sure ?</x-button>
                    @else
                        <x-button wire:click="confirmDelete" class="w-24" danger >Delete</x-button>
                    @endif
                @endif
                
            </div>
        </div>
    </div>
</div>

<script>
    function removeClass(el,theclass,delay){            
            setTimeout(() => {
                el.classList.remove(theclass);
            }, delay);
        }
</script>