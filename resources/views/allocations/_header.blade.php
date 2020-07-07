<div class="inline-block w-auto p-0 ml-8 border rounded">
    <select class="px-2 py-1" wire:model="action">
        <option value="">Choose Action</option>
        <option value="create">Create Orders</option>
    </select>
    <button class="px-2 py-2 font-bold border border-t-0 border-b-0 border-r-0 rounded-r hover:bg-teal-700 hover:text-white" wire:click.prevent="go">Go</button>
</div>