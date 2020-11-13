<div class="bg-gray-200">

    <div class="flex flex-row items-center justify-between pt-2 mx-4 my-2">
    <h2 class="text-xl font-bold text-teal-800 ">Allocation {{ $allocation_id }}</h2>
        <a href="{{ route('allocations.index')}}"
            class="px-4 py-1 text-sm bg-gray-100 border rounded hover:bg-gray-300">Return to Index</a>
    </div>

    <div class="flex flex-row border-t-2 border-gray-400" wire:poll.20s>

        <div class="w-3/4 my-4 border-r-2 border-gray-400">

            <div class="flex flex-row text-gray-800">
                <div class="flex flex-col w-11/12 py-4 pl-4 pr-4 m-4 space-y-2 bg-white border border-gray-300 rounded">

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

                {{-- Controls --}}
                <div class="w-1/12 mt-8 mr-4 space-y-1">
                    @if($editing)
                    <x-button wire:click="save" class="w-full" active>Save</x-button>
                    @else
                    <x-button wire:click="editMode" class="w-full">Edit</x-button>
                    @endif

                    <div class="w-full"></div>

                    @if(!$editing)
                    @if($confirming)
                    <x-button wire:click="kill()" class="w-full" danger active>Sure?</x-button>
                    @else
                    <x-button wire:click="confirmDelete()" class="w-full" danger>Delete</x-button>
                    @endif
                    @endif
                </div>
            </div>

            @if($allocation_id)
                @livewire('allocations.allocation-stock', ['allocation' => $allocation])
                @livewire('notes-component',['notable' => $allocation ])
            @endif

        </div>

        @if($allocation->id && $allocation->status == App\Allocation::START)

            <div class="w-1/4 p-2">

                <div class="p-2 mt-2 text-sm leading-normal text-gray-900 bg-yellow-100 border border-yellow-200 rounded-lg shadow-lg">
                    This Allocation is in <strong>Draft</strong> state and you can <a
                        class="inline-block px-1 py-0 font-semibold leading-tight text-indigo-800 border rounded shadow hover:bg-indigo-100 hover:underline"
                        href="{{ route('prepare.orders.single',$allocation) }}">create an order</a> for this Allocation.<br /><br />
                    If you want to place an order for multiple Allocations then this is done by selecting several allocations on the
                    <a class="inline-block px-1 py-0 font-semibold leading-tight text-indigo-800 border rounded shadow hover:bg-indigo-100 hover:underline"
                        href="{{ route('allocations.index')}}">index page</a>
                    and selecting Create Order from Action the menu.
                </div>

                @include('allocations._info-copy-allocation')

                <div class="p-2 mt-2 text-sm leading-normal text-gray-900 bg-yellow-100 border border-yellow-200 rounded-lg shadow-lg">
                    <x-svg.exclamation class="h-5" /> Any changes you make here are saved immediately.
                </div>
            </div>

        @endif
        @if($allocation->status && $allocation->status == App\Allocation::INPROGRESS )

            <div class="w-1/4 p-2">
                <div class="p-2 text-sm leading-normal text-gray-900 bg-yellow-100 border border-yellow-200 rounded-lg shadow-lg">
                    You can <a class="inline-block px-1 py-0 font-semibold leading-tight text-indigo-800 border rounded shadow hover:bg-indigo-100 hover:underline" 
                        href="{{ route('shipment.create',$allocation) }}">create a single shipment</a> for this Allocation. <br /><br />
                    If you want to ship multiple Allocations to one place then this is done by selecting several allocations on the previous screen and
                    selecting Create Shipment from the menu.
                </div>
                

                @include('allocations._info-copy-allocation')
                
            </div>

        @endif

        @if($allocation->status && $allocation->status == App\Allocation::SHARED)
                
                <div class="w-1/4 p-2 mt-2">
                    <div class="p-2 text-sm leading-normal text-gray-900 bg-yellow-100 border border-yellow-200 rounded-lg shadow-lg">
                        This Allocation has been <strong>shared</strong> for editing.  It cannot be progressed until moved back to draft.
                    </div>
                    <div class="p-2 mt-4 text-sm leading-normal text-gray-900 bg-yellow-100 border border-yellow-200 rounded-lg shadow-lg">
                        The link for sharing is below.  Anyone with this link can adjust the allocation.
                        <div class="flex justify-center">
                            <button class="px-4 py-1 font-bold text-gray-700 transition duration-300 bg-white border rounded shadow-lg hover:bg-teal-700 hover:text-white" onClick="copyShare()">Copy Link to Clipboard</button>
                        </div>
                    </div>
                
                </div>
                
                @endif
    </div>

    @if($showFoodbankPicker)
        @include('admin.clubs.foodbank-modal')
    @endif

    <script>
        function removeClass(el,theclass,delay) {
            setTimeout(() => {
                el.classList.remove(theclass);
            }, delay);
        }
    </script>

    <script>
        function copyShare() {
            navigator.clipboard.writeText('{{ $shared_url }}')
                .then(() => { alert(`Copied the link to your clipboard`) })
                .catch((error) => { alert(`Copy failed! ${error}`) })
        }
    </script>

</div>