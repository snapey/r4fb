<div wire:poll.20s>
    <h2 class="pt-2 mx-4 my-3 text-xl font-bold border-t-2 border-gray-400">Notes</h2>
    
    <div class="flex flex-col mx-4 space-y-2">
        
        <div class="flex flex-row px-2 pt-1 pb-1 space-x-4 text-xs leading-tight text-gray-700 bg-white rounded shadow">
            <textarea wire:model="newnote" class="w-full px-2 py-1" name="newnote" id="newnote"
                placeholder="Create a new note (at least 10 characters)"></textarea>
            <button wire:click="saveNote" class="h-8 px-2 py-1 text-xs rounded 
                                    @if($dirtyNote)text-white bg-teal-600 font-bold
                                    @else text-gray-400 bg-gray-100 border border-gray-300 font-base
                                    @endif
                                    ">Save</button>
        </div>

        {{-- Output existing notes --}}
        @foreach($notes as $note)
            <div x-data x-init="removeClass($el,'bg-green-300',2500)" wire:key="{{ $note->id }}"
                class="
                @if($note->recentlyUpdated) bg-green-300 @endif
                border-l-4 border-teal-500
                flex flex-row px-4 py-1 text-gray-800 transition-all duration-150 bg-white ease-in rounded shadow hover:bg-yellow-300">
                <div class="flex-1 py-1 text-sm leading-snug ">{!! nl2br(e($note->memo)) !!}</div>
                <div class="flex-none text-xs leading-snug text-right text-gray-600">
                    {{$note->user->name ?? 'anon' }}<br>{{ $note->updated_at->format('H:i D d/m/y') }}</div>
            </div>
        @endforeach
    </div>
</div>
