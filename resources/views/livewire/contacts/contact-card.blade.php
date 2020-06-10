<div>
    <div wire:click="showModal" class="py-2 pl-4 pr-2 m-4 overflow-hidden bg-white rounded shadow cursor-pointer">
        <ul class="space-y-2">
            <li>{{ $contact->forenames }} {{ $contact->surname }} 
                <a wire:click.stop title="Click to visit contact record" href="{{ route('admin.contacts.show',$contact) }}">
                    <x-svg.contact class="inline-block float-right w-6 text-gray-500 hover:text-indigo-700" /></a>
            </li>
            <li class="text-sm">{{ $contact->phone1}}</li>
            <li class="text-sm"><a href="mailto:{{ $contact->email1}}" target="_blank" class="text-indigo-700 underline">{{ $contact->email1}}</a></li>
            <li class="text-xs text-gray-700">{{ $contactable['relationship'] }}</li>
        </ul>
        @if($showing)
            @livewire('contacts.modal', ['model' => $contact, 'contactable' => $contactable])
        @endif
    </div>
</div>
