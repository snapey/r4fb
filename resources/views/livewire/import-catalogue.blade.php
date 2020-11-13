<div class="flex items-center float-right px-2 py-1 my-1 ml-auto rounded-lg">
    <label class="w-40 px-2 py-2 text-xs font-bold text-center text-teal-100 bg-teal-700 border border-gray-500 rounded shadow-md hover:bg-teal-600" for="upload.{{ $iteration }}">
        @if($loaded) >>>> @else Upload New Catalog @endif</label>
    <input class="hidden" id="upload.{{ $iteration }}" wire:model="upload" type="file" name="uploadcatalog" />
    <x-button class="px-2" active wire:click="process">GO</x-button>
</div>