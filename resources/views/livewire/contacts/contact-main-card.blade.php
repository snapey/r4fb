<div class="bg-gray-100">

    <h2 class="pt-2 mx-4 my-2 text-xl font-bold ">Contact</h2>
    <div class="flex flex-row pt-4 border-t-2 border-gray-400" wire:poll.20s>

        {{-- fields --}}
        <div class="flex flex-col w-9/12 px-4 space-y-3">
            <div class="flex flex-row items-center">
                <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="fornames">Forenames:</label>
                <input {{ !$editing ? 'disabled': '' }}
                    class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                    wire:model.lazy="forenames" name="forenames" type="text" />
            </div>
            @error('forenames')
            <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
            @enderror

            <div class="flex flex-row items-center">
                <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="surname">Surname:</label>
                <input {{ !$editing ? 'disabled': '' }}
                    class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                    wire:model.lazy="surname" name="surname" type="text" />
            </div>
            @error('surname')
            <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
            @enderror

            @include('admin.contacts._candidates')

            <div class="flex flex-row items-center">
                <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="phone1">Phone:</label>
                <input {{ !$editing ? 'disabled': '' }}
                    class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                    wire:model.lazy="phone1" name="phone1" type="text" />
            </div>
            @error('phone1')
            <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
            @enderror

            <div class="flex flex-row items-center">
                <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="phone2">Alt. Phone:</label>
                <input {{ !$editing ? 'disabled': '' }}
                    class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                    wire:model.lazy="phone2" name="phone2" type="text" />
            </div>
            @error('phone2')
            <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
            @enderror

            <div class="flex flex-row items-center">
                <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="email1">Email:</label>
                <input {{ !$editing ? 'disabled': '' }}
                    class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                    wire:model.lazy="email1" name="email1" type="text" />
            </div>
            @error('email1')
            <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
            @enderror

            <div class="flex flex-row items-center">
                <label class="flex-1 inline-block w-3/12 text-sm font-bold" for="email2">Alt. Email:</label>
                <input {{ !$editing ? 'disabled': '' }}
                    class="inline-block w-9/12 px-2 py-1 bg-gray-200 border @if($editing) border-teal-600 @endif rounded"
                    wire:model.lazy="email2" name="email2" type="text" />
            </div>
            @error('email2')
            <div class="inline-block w-9/12 ml-3 text-xs text-red-800 ">{{ $message }}</div>
            @enderror

        {{-- relationships ---------------------------------------------------- --}}
        @include('livewire.contacts._relationships')
        
        {{-- notes ---------------------------------------------------- --}}
        <h2 class="pt-2 my-3 text-xl font-bold border-t-2 border-gray-400">Notes</h2>
        <div class="flex flex-col space-y-2">
            @livewire('notes.newnote', ['model' => $contact])
            @foreach($contact->notes as $note)
                @livewire('notes.note-card', compact('note'), key($note->id))
            @endforeach
        </div>

        {{-- controls ------------------------------------------------- --}}
        </div>

        <div class="w-3/12 text-center">
            <div class="flex flex-col px-4 space-y-3 border-l-4 border-gray-300">

                @if($editing)
                <button wire:click="save"
                    class="box-border w-24 py-2 text-xs font-bold text-center text-white bg-teal-600 border border-gray-400 rounded hover:bg-teal-700">Save</button>
                @else
                <button wire:click="editMode"
                    class="box-border w-24 py-2 text-xs font-bold text-center text-gray-700 border border-gray-400 rounded">Edit</button>
                @endif

                <button wire:click="cancel"
                    class="box-border w-24 py-2 text-xs font-bold text-center text-gray-700 border border-gray-400 rounded ">Cancel
                </button>
                    
                @if($exists)
                    @if($confirming)
                        <button wire:click="kill"
                            class="box-border w-24 py-2 text-xs font-bold text-center text-white bg-red-600 border border-gray-400 rounded hover:bg-red-700 ">
                            You Sure ?
                        </button>
                    @else
                        <button wire:click="confirmDelete"
                            class="box-border w-24 py-2 text-xs font-bold text-center text-gray-700 border border-gray-400 rounded hover:bg-red-600 hover:text-white ">
                            Delete
                        </button>
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