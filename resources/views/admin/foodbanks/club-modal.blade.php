<div>
    <div class="fixed top-0 left-0 z-20 flex items-center justify-center w-full h-full modal">
        <div class="absolute w-full h-full bg-gray-900 opacity-50 pointer-events-none modal-overlay"></div>

        <div class="container z-50 max-w-4xl mx-auto overflow-y-auto bg-white rounded shadow-lg" style="height: 80vh;">

            <div
                class="absolute top-0 right-0 z-50 flex flex-col items-center my-4 mr-4 text-sm text-white cursor-pointer">
                <a href="#" wire:click.prevent="$set('showClubsPicker',false)">
                    <svg class="text-white fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </a>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="px-4 py-4 mb-4 text-left modal-content">
                <!--Title-->
                <div class="flex items-center justify-between pb-3">
                    <p class="text-2xl font-bold">Select a Club</p>
                    <div class="z-50 modal-close">
                        <a href="#" wire:click.prevent="$set('showClubsPicker',false)">
                            <svg class="text-black fill-current" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!--Body-->
                @livewire('clubs.clubs-picker')

            </div>
        </div>
    </div>
</div>