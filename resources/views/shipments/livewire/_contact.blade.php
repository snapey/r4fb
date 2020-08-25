<div class="flex flex-row justify-between py-1">
    <label for="recipient-{{ $contact->id }}">{{ $contact->forenames }} {{ $contact->surname }}
        <span class="text-sm italic text-gray-700">{{ $contact->pivot->relationship }}</span>

        @if(!empty($contact->email1))
            <span class="text-indigo-800">&lt;{{ $contact->email1 }}&gt;</span>
        @endif
    </label>
        
    @if(empty($contact->email1))
    <span class="px-1">-</span>
    @else
    <input wire:model="recipients.{{ $contact->id }}" type="checkbox" name="recipient-{{ $contact->id }}" id="recipient-{{ $contact->id }}">
    @endif
</div>