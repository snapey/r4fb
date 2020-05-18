<div class="bg-gray-100">

    <div class="flex flex-row items-center justify-between pt-2 mx-4 my-2">
        <h2 class="text-xl font-bold text-teal-800 ">FOOD BANK</h2>
        <a href="{{ route('admin.foodbanks.index')}}" class="px-4 py-1 text-sm border rounded hover:bg-gray-300">Return to Index</a>
    </div>

    <div class="flex flex-row border-t-2 border-gray-400" wire:poll.20s>

        <div class="w-3/4 my-4 border-r-2 border-gray-400">
        <h2 class="mx-4 text-xl font-bold ">{{ $name }}</h2>

            @include('admin.foodbanks._details')

        {{--don't show if new foodbank --}}
        @if($foodbank_id)
            @include('admin.addresses.card',['addresses'=>$foodbank->addresses])

            @include('admin.foodbanks._clubs')
            
            <h2 class="pt-2 mx-4 my-3 text-xl font-bold border-t-2 border-gray-400">Notes</h2>
        
            <div class="flex flex-col mx-4 space-y-2">
                @livewire('notes.newnote', ['model' => $foodbank])
                @foreach($foodbank->notes as $note)
                    @livewire('notes.note-card', compact('note'), key($note->id))
                @endforeach
            </div>
        @endif
        </div>

        {{-- don't show if new foodbank --}}
        @if($foodbank_id)
            <div class="w-1/4 bg-gray-100">
                @foreach($foodbank->contacts as $contact)
                    @livewire('contacts.contact-card', ['contact' => $contact], key($contact->id))
                @endforeach
                @livewire('contacts.newcontact', ['model' => $foodbank] )
            </div>
        @endif
    </div>

    @if($showClubsPicker)
        @include('admin.foodbanks.club-modal')
    @endif

    <script>
        function removeClass(el,theclass,delay){            
            setTimeout(() => {
                el.classList.remove(theclass);
            }, delay);
        }
    </script>

</div>