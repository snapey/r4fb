<div class="bg-gray-100">

    <div class="flex flex-row items-center justify-between pt-2 mx-4 my-2">
        <h2 class="text-xl font-bold text-teal-800 ">SHIPPER</h2>
        <a href="{{ route('admin.shippers.index')}}" class="px-4 py-1 text-sm border rounded hover:bg-gray-300">Return to
            Index</a>
    </div>

    <div class="flex flex-row border-t-2 border-gray-400" wire:poll.20s>

        <div class="w-3/4 my-4 border-r-2 border-gray-400">
            <h2 class="mx-4 text-xl font-bold ">{{ $name }}</h2>

            @include('admin.shippers._details')

            @if($shipper->id)
                @livewire('addresses.address-component',['addressable' => $shipper ])

                <h2 class="pt-2 mx-4 my-3 text-xl font-bold border-t-2 border-gray-400">Notes</h2>

                <div class="flex flex-col mx-4 space-y-2">
                    @livewire('notes.newnote', ['model' => $shipper])
                    @foreach($shipper->notes as $note)
                    @livewire('notes.note-card', compact('note'), key($note->id))
                    @endforeach
                </div>
            @endif

        </div>

        <div class="w-1/4 bg-gray-100">
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