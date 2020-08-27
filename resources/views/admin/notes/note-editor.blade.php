<div x-show="editor" x-cloak>
    <div class="fixed top-0 left-0 z-20 flex items-center justify-center w-full h-full modal">
        <div class="absolute w-full h-full bg-gray-900 opacity-50 pointer-events-none modal-overlay"></div>

        <div class="container z-50 max-w-2xl mx-auto overflow-y-auto bg-white rounded shadow-lg" style="height: 55vh;">

            <div
                class="absolute top-0 right-0 z-50 flex flex-col items-center my-4 mr-4 text-sm text-white cursor-pointer">
                <a href="#" x-on:click.prevent="editor=false;window.livewire.emit('closed')">
                    <svg class="text-white fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </a>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="px-4 py-4 modal-content">
                <!--Title-->
                <div class="flex items-center justify-between pb-3">
                    @if(is_null($note_id))
                        <p class="text-xl font-bold">Create New Note</p>
                    @else
                        <p class="text-xl font-bold">Edit Note</p>
                    @endif

                    <div class="z-50 modal-close">
                        <a href="#" x-on:click.prevent="editor=false;window.livewire.emit('closed')"" >
                            <svg class="text-black fill-current" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!--Body-->
                <div class="flex flex-col px-2 pt-1 pb-1 space-y-3 text-sm leading-tight text-gray-800 bg-white">
                    <textarea wire:model="memo" class="w-full px-2 py-1 border rounded shadow" name="memo" id="memo"
                        placeholder="Create a new note (at least 10 characters)" rows="3"></textarea>
                    @error('memo')
                        <span class="mt-1 text-red-700">{{ $message }}</span>
                    @enderror
                    <x-inputs.checkbox-editable editing="1" name="pinned" label="Pinned to top" checked="{{$pinned}}"  />
                    <x-inputs.checkbox-editable editing="1" name="external" label="Visible externally" checked="{{$external}}"  />

                    <h2 class="mb-2 text-sm font-bold">Attachments:</h2>
                    <div class="flex flex-row items-center">
                        <input wire:model="attachment" type="file" name="attachment" id="upload{{ $iteration }}" />
                        @if($attachment)
                        <button wire:click="saveAttachment" 
                                class="px-4 py-1 text-xs font-bold border border-teal-600 rounded-full shadow hover:bg-gray-200">Save Attachment</button>
                                @endif
                        <div wire:loading wire:target="attachment" class="font-bold text-blue-700 ">Uploading...</div>
                    </div>
                    @error('attachment') <span class="text-red-500">{{ $message }}</span> @enderror
                    
                    <ul class="ml-4 leading-snug list-disc">
                    @foreach($attachments as $attached)
                    <li><a class="text-indigo-700 hover:underline" 
                            href="{{ \Storage::disk('uploads')->url($attached['path']) }}" target="_blank">{{ $attached['label'] }}</a></li>
                    @endforeach
                    </ul>
                    
                    
                    @if(is_null($note_id))
                        <div class="mt-2 text-right">
                            @if($dirtyNote)
                                <x-button wire:click="saveNote()" class="h-8 px-4 ml-4" active >Save Note &amp; Close</x-button>
                            @endif
                        </div>
                    @else
                        <div class="mt-2 text-right">
                            @if($confirming)
                                <x-button wire:click="kill()" class="w-2/12 h-8" danger active>You Sure?</x-button>
                            @else
                                <x-button wire:click="confirmDelete()" class="w-2/12 h-8" danger>Delete Note</x-button>
                            @endif
                            <x-button wire:click="updateNote()" class="w-2/12 h-8 ml-4" active>Update</x-button>
                        </div>
                    @endif
                
                </div>

            </div>
        </div>
    </div>
</div>