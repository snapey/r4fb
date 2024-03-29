<div class="flex flex-row items-center justify-between w-full">
    <div class="inline-block w-auto p-0 ml-8 border rounded">
        <select class="px-2 py-1" wire:model="action">
            <option value="">Choose Action</option>
            <option value="create">Create Orders</option>
            <option value="shipment">Create Shipment</option>
        </select>
        <button class="px-2 py-2 font-bold border border-t-0 border-b-0 border-r-0 rounded-r hover:bg-teal-700 hover:text-white" wire:click.prevent="go">Go</button>
    </div>
    <div class="m-4 text-left">
        <x-inputs.select-editable editing="1" name="statusFilter" label="Filter by Status:" :list="$statuses" />
    </div>
    <div class="m-4 text-left">
        <x-inputs.select-editable editing="1" name="per_page" label="Per Page:" :list="$perPageOptions" half />
    </div>
</div>