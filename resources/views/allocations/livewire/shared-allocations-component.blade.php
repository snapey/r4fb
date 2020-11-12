<div class="bg-gray-200">

    <div class="flex flex-row items-center justify-between pt-2 mx-4 my-2">
    <h2 class="text-xl font-bold text-teal-800 ">Allocation {{ $allocation_id }}</h2>
    </div>

    <div class="flex flex-row border-t-2 border-gray-400" wire:poll.20s>

        <div class="w-3/4 my-4 border-r-2 border-gray-400">

            <div class="flex flex-row text-gray-800">
                <div class="flex flex-col w-full py-4 pl-4 pr-4 m-4 space-y-2 bg-white border border-gray-300 rounded">

                    <x-inputs.select-editable 
                        editing="{{ is_null($allocation_id) ? false : $editing }}"
                        name="status" current="{{ $status }}" label="Status:" :list="$statuses" half 
                    />

                    <div class="flex flex-row items-center">
                        <div class="flex items-center justify-between w-3/12">
                            <span class="block text-sm font-bold">Foodbank:</span>
                            @if($foodbank_id)
                                <a href="{{ route('admin.foodbanks.show',$foodbank_id)}}"><x-svg.foodbank class="h-5 px-1 text-indigo-700 hover:text-indigo-900" /></a>
                            @endif
                        </div>
                        <span class="inline-block w-7/12 px-2 py-2 bg-gray-200 rounded">{{ $foodbank }}</span>
                        @if($editing)
                            <x-button wire:click="$set('showFoodbankPicker',true)" class="w-2/12 ml-8">Change Foodbank</x-button>
                        @endif
                    </div>
                    @error('foodbank')
                        <div class="flex flex-row">
                            <div class="w-3/12"></div>
                            <div class="w-9/12 text-xs text-red-800 full ">{{ $message }}</div>
                        </div>
                    @enderror

                    <x-inputs.text-editable editing="{{ $editing }}" name="budget" label="Budget: (£)" half />
                    <x-inputs.text-editable name="created_by" label="Created By:" half />
                </div>
            </div>


            @if($allocation_id)
                @livewire('allocations.allocation-stock', ['allocation' => $allocation])
            @endif
            
        </div>

        <div class="w-1/4 p-2">
            <div
                class="p-2 mt-2 text-sm leading-normal text-gray-900 bg-yellow-100 border border-yellow-200 rounded-lg shadow-lg">
                This Allocation has been shared with you so that you can add items to the 'order' and 
                set the quantities.  You should be aiming for as close to the budget as possible and 
                with the minimum number of <strong>Items</strong>, as advised by R4FB.<br /><br />
                Click the <strong>Add Items</strong> button. A window will appear, from which you can add order lines.  As items
                are clicked, they will be added to the Allocation and a small tick appears next to the item.
                When you close the window, the items will be ready for you to indicate how many of each item is required.
                When finished, press the <strong>Finished button</strong> below.
                <div class="flex justify-center mt-8">
                    <button
                        class="px-4 py-1 font-bold text-gray-700 transition duration-300 bg-white border rounded shadow-lg hover:bg-teal-700 hover:text-white"
                        wire:click="finished">Finished adding items</button>
                </div>
            </div>
        </div>



    </div>

    <script>
        function removeClass(el,theclass,delay) {
            setTimeout(() => {
                el.classList.remove(theclass);
            }, delay);
        }
    </script>

</div>