<div  x-cloak x-show="picker">
    <div class="fixed top-0 left-0 z-20 flex items-center justify-center w-full h-full modal">
        <div class="absolute w-full h-full bg-gray-900 opacity-50 pointer-events-none modal-overlay"></div>

        <div class="container z-50 max-w-2xl mx-auto overflow-y-auto bg-white rounded shadow-lg" style="height: 80vh;">

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="px-4 py-4 mb-4 text-left modal-content" x-on:click.away="picker=false">
                <!--Title-->
                <div class="flex items-center justify-between pb-3">
                    <p class="text-2xl font-bold">Select Items</p>
                    <div class="z-50 modal-close"><a href="#" x-on:click.prevent="picker=false"><x-svg.x class="w-5" /></a></div>
                </div>

                <!--Body-->
                @livewire('items.items-picker',['exists'=> Illuminate\Support\Arr::pluck($stocks,'item_id')])
                <button x-on:click.prevent="picker=false" class="px-4 py-1 text-xs bg-yellow-200 border border-yellow-400 rounded shadow hover:bg-yellow-300">Close</button>
            </div>
        </div>
    </div>
</div>