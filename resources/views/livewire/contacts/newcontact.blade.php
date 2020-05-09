<div>
            <div class="p-4 m-4 overflow-hidden bg-white rounded shadow">
                <a href="#" wire:click.prevent="add()"> + Add New Contact</a>
            </div>
            @if($showing)
                @include('livewire.contacts.modal')
            @endif
</div>
