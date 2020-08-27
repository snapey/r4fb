<div wire:poll.20s x-data="{ editor: false }" x-on:closemodal="editor=false">
    <div class="flex flex-row items-center justify-between mx-4 my-3 border-t-2 border-gray-400 ">
        <h2 class="pt-2 my-1 text-xl font-bold ">Notes</h2>
        <x-button x-on:click.prevent="editor=true;window.livewire.emit('editoropen')"
            active class="px-4 ">+ Add a note</x-button>
    </div>
    
    <div class="flex flex-col mx-4 space-y-2">
        
        {{-- Output existing notes --}}
        @foreach($notes as $note)
        <div class="relative">
            
            @if($note->attachments->count() > 0 || $note->external)
            <div class="absolute z-10 inline-block py-px mx-2 -mt-1 text-xs">
                @if($note->attachments->count() > 0)
                    <div class="inline-block px-2 text-blue-800 bg-blue-300 border border-blue-400 rounded-full shadow">
                        Has {{ $note->attachments->count() }} {{ $note->attachments->count() > 1 ? 'attachments' : 'attachment' }}
                    </div>
                @endif
            
                @if($note->external)
                    <div class="inline-block px-2 text-yellow-900 bg-yellow-400 border border-yellow-500 rounded-full shadow">
                        External Note
                    </div>
                @endif
            </div>
            @endif
            
            <div x-init="removeClass($el,'bg-green-300',2500)" wire:key="{{ $note->id }}"
                class="
                @if($note->recentlyUpdated) bg-green-300 @endif

                {{ $note->pinned ? 'border-red-500' : 'border-teal-500' }}
        
                border-l-4 flex flex-row items-center px-2 py-1 text-gray-800 transition-all duration-150 bg-white ease-in rounded shadow hover:bg-yellow-300">
                <div class="flex-1 py-1 text-sm leading-snug ">{!! nl2br(e($note->memo)) !!}</div>
                <div class="flex-none text-xs leading-snug text-right text-gray-600">
                    {{$note->user->name ?? 'anon' }}<br>{{ $note->updated_at->format('H:i D d/m/y') }}
                </div>
                <div><a href="#" x-on:click.prevent="editor=true;window.livewire.emit('editoropen',{{ $note->id }})" ><x-svg.pencil-alt class="h-5 pl-2 text-gray-600 transition duration-100 hover:text-gray-800" /></a></div>
            </div>
        </div>
        @endforeach
        
        @include('admin.notes.note-editor')

    </div>

</div>
