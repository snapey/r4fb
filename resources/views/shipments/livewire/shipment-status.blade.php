<div class="mt-4" wire:poll.60s>
    <h2 class="pt-2 my-3 text-xl font-bold border-t-2 border-gray-400">Status - {{ $shipment->status }}</h2>
    <div class="px-4">
        <label for="received" class="inline-block w-64 {{ $received_state == 'disabled'?'text-gray-500':'' }}">Mark as Received 
            <input wire:model="received"  type="checkbox" {{ $received_state }} name="received" id="received" />
        </label>
        <label for="cancelled" class="inline-block w-64 {{ $cancelled_state == 'disabled'?'text-gray-500':'' }}">Mark as Cancelled 
            <input wire:model="cancelled" type="checkbox" {{ $cancelled_state }} name="cancelled" id="cancelled" />
        </label>
        <label for="updated" class="inline-block w-64">Last Update <span class="text-teal-800">{{ $shipment->updated_at->format('d/m/Y g:i a') }}</span></label>

    </div>
</div>
