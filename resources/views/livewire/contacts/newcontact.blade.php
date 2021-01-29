<div>
    @can('Contacts.add')
            <div class="p-4 m-4 overflow-hidden transition duration-200 bg-white rounded shadow hover:bg-green-200 hover:shadow-lg">
                <a href="#" wire:click.prevent="add()"> + Add New Contact</a>
            </div>
            @if($showing)
                @include('livewire.contacts.modal')
            @endif
    @endcan
</div>
