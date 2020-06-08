<div class="bg-gray-200" x-data x-on:keydown.escape="window.livewire.emit('closeModals')">

    <div class="flex flex-row items-center justify-between pt-2 mx-4 my-2">
        <h2 class="text-xl font-bold text-teal-800 ">FOOD BANK</h2>
        <a href="{{ route('admin.foodbanks.index')}}" class="px-4 py-1 text-sm bg-gray-100 border rounded hover:bg-gray-300">Return to Index</a>
    </div>

    <div class="flex flex-row border-t-2 border-gray-400" wire:poll.20s>

        <div class="w-3/4 my-4 border-r-2 border-gray-400">
        <h2 class="mx-4 text-xl font-bold ">{{ $name }}
        @if($foodbank->foodbankIsApproved())<span 
            class="relative inline-block px-2 py-1 ml-4 -mt-2 text-xs font-normal font-bold text-yellow-900 bg-yellow-400 rounded-lg shadow " style="top: -0.4rem;">Approved</span> @endif </h2>

            @include('admin.foodbanks._details')

        {{--don't show if new foodbank --}}
        @if($foodbank_id)
            @livewire('address-component',['addressable' => $foodbank ])

            @include('admin.foodbanks._clubs')

            @livewire('notes-component',['notable' => $foodbank ])
            
        @endif
        </div>

        {{-- don't show if new foodbank --}}
        @if($foodbank_id)
            <div class="w-1/4">
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