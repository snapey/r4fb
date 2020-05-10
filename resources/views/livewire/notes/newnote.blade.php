<div class="flex flex-row px-2 pt-2 pb-1 space-x-4 leading-tight text-gray-700 bg-white rounded shadow">
    <textarea wire:model="newnote" class="w-full px-2" name="newnote" id="newnote"
        placeholder="Create a new note (at least 10 characters)"></textarea>
    <button wire:click="saveNote" class="h-8 px-2 py-1 text-xs rounded 
                            @if($dirtyNote)text-white bg-teal-600 font-bold
                            @else text-gray-400 bg-gray-100 border border-gray-300 font-base
                            @endif
                            ">Save
    </button>
</div>
