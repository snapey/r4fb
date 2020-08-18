<div class="flex flex-row items-center">
    <div class="w-4/12 m-4 text-left">
        <x-inputs.select-editable editing="1" name="statusFilter" label="Filter by Status:" :list="$statuses" />
    </div>
    <div class="w-4/12 m-4 text-left">
        <x-inputs.select-editable editing="1" name="per_page" label="Per Page:" :list="$perPageOptions" half />
    </div>
</div>