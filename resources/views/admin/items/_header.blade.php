<div class="flex flex-row items-center">
    <div class="w-4/12 m-4 text-left py-2 px-2 border-2 rounded-lg {{ $statusFilter ? 'border-red-400 bg-red-100':'border-gray-100'}}">
        <x-inputs.select-editable editing="1" name="statusFilter" label="Filter:" :list="$statuses" />
    </div>
    <div>
        <a href="{{route('admin.items.download',['filter'=>$this->statusFilter])}}"><x-button class="px-4" >Download</x-button></a>
    </div>
</div>