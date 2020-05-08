<div class="bg-gray-100">
    <h2 class="pt-2 mx-4 my-2 text-xl font-bold ">Foodbank</h2>
    <div class="flex flex-row border-t-2 border-gray-400" wire:poll.20s>

        <div class="w-3/4 my-4 border-r-2 border-gray-400">
        <h2 class="mx-4 text-xl font-bold">{{ $attr['name'] }}</h2>

            @include('admin.foodbanks._details')
            
            <h2 class="pt-2 mx-4 my-2 text-xl font-bold border-t-2 border-gray-400">Notes</h2>
        
            <div class="flex flex-col mx-4 space-y-2">
                <div class="flex flex-row px-2 pt-2 pb-1 space-x-4 leading-tight text-gray-700 bg-white rounded shadow">
                    <textarea wire:model="newnote" class="w-full px-2" name="newnote" id="newnote" placeholder="create a new note"></textarea>
                        <button wire:click="saveNote" class="h-8 px-2 py-1 text-xs rounded 
                            @if($dirtyNote)text-white bg-teal-600 font-bold
                            @else text-gray-400 bg-gray-100 border border-gray-300 font-base
                            @endif
                            ">Save
                        </button>
                </div>
                @foreach($foodbank->notes as $note)
                    @livewire('notes.note-card', compact('note'), key($note->id))
                @endforeach
            </div>
        </div>

        <div class="w-1/4 bg-gray-100">
            @foreach($foodbank->contacts as $contact)
                @livewire('contacts.contact-card', compact('contact'), key($loop->index))
            @endforeach
        </div>

    </div>

    <script>
        function removeClass(el,theclass,delay){            
            setTimeout(() => {
                el.classList.remove(theclass);
            }, delay);
        }
    </script>

</div>