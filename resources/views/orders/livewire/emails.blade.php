<div x-data="{opened: false}" x-show="opened" x-cloak x-on:emailpanel.window="opened=true">
    <div class="fixed top-0 left-0 z-20 flex items-center justify-center w-full h-full modal">
        <div class="absolute w-full h-full bg-gray-900 opacity-50 pointer-events-none modal-overlay"></div>

        <div class="container z-50 max-w-4xl mx-auto overflow-y-auto bg-white rounded shadow-lg" style="height: 80vh;">

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="px-4 py-4 mb-4 text-left modal-content">
                <!--Title-->
                <div class="flex items-center justify-between pb-3 border-b-2">
                    <p class="text-xl font-bold">Order Email Centre</p>
                    <div class="z-50 modal-close">
                        <a href="#" x-on:click="opened=false">
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

                <div class="flex flex-row text-sm text-gray-800">

                    <div class="w-6/12">

                        <h3 class="my-4 text-xl font-bold">Supplier:</h3>
                        @each('orders.livewire._contact',$order->supplier->contacts,'contact')

                        <h3 class="my-4 text-xl font-bold">Send a copy to user:</h3>
                        @each('orders.livewire._user',App\User::all(),'user')


                    </div>

                    <div class="w-6/12 pl-8">
                        <label class="block w-full px-2 py-2 text-sm font-bold" for="template_id">Choose a
                            template:</label>
                        <select
                            class="w-full px-1 py-1 mb-2 text-base leading-tight text-gray-700 border rounded shadow focus:outline-none focus:shadow-outline"
                            name="template_id" id="template_id" wire:model="template_id">
                            <option value="">Choose</option>
                            @foreach($templates as $tp)
                            <option value="{{ $tp->id }}">{{ $tp->title }}</option>
                            @endforeach
                        </select>

                        <p class="px-2 mb-2 text-sm italic ">{{ $purpose ?? ''}}</p>

                        <div class="w-full mt-4">
                            <label for="subject"
                                class="block mx-2 mb-2 text-sm font-bold text-gray-800">Subject:</label>
                            <input wire:model="subject" id="subject" type="text" name="subject" class="text-base shadow border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline 
                                    @error('subject') border-red-500 @enderror">
                            @error('subject')
                            <p class="mt-4 text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full mt-2 text-sm" wire:ignore>
                            <label class="block w-full px-2 py-2 text-sm font-bold">Email message to send:</label>
                            <textarea class="w-full p-3 text-sm" rows='16' id="template"></textarea>
                        </div>

                        <div class="flex flex-row items-center justify-between">
                            <p><strong>Order PDF will always be attached</strong></p>
                            @if($rcount)
                            <x-button wire:loading.remove wire:target="send" wire:click="send"
                                class="float-right px-4 mt-2" active>
                                Send to {{ $rcount }} Contacts</x-button>
                            <p wire:loading wire:target="send" class="px-4 my-3 font-bold text-red-700">Sending</p>
                            @endif
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>