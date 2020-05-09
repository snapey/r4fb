<div>
    <div wire:click="showModal" class="px-4 py-2 m-4 overflow-hidden bg-white rounded shadow">
        <ul class="space-y-2">
            <li>{{ $contact->forenames }} {{ $contact->surname }}</li>
            <li>{{ $contact->phone1}}</li>
            <li><a href="mailto:{{ $contact->email1}}" target="_blank" class="text-indigo-700 underline">{{ $contact->email1}}</a></li>
            <li class="text-xs text-gray-700">{{ $contactable['relationship'] }}</li>
        </ul>
        @if($showing)
            @livewire('contacts.modal', ['model' => $contact, 'contactable' => $contactable])
        @endif
    </div>
</div>
