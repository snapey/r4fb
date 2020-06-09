<div x-data="{opened: false}" x-show="opened" x-cloak x-on:easycopy.window="opened=true">
    <div class="fixed top-0 left-0 z-20 flex items-center justify-center w-full h-full modal">
        <div class="absolute w-full h-full bg-gray-900 opacity-50 pointer-events-none modal-overlay"></div>

        <div class="container z-50 max-w-4xl mx-auto overflow-y-auto bg-white rounded shadow-lg" style="height: 80vh;">

            <div
                class="absolute top-0 right-0 z-50 flex flex-col items-center my-4 mr-4 text-sm text-white cursor-pointer">
                <a href="#" x-on:click="opened=false">
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
                    <p class="text-xl font-bold">Foodbank Easy Copy</p>
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

                <h3 class="my-4 text-xl font-bold">Addresses:</h3>
                <div class="flex flex-row flex-wrap ">

                    @foreach($foodbank->addresses as $address)
                    <div class="w-1/3 p-2">
                        <div class="w-full h-full p-4 text-sm leading-normal bg-gray-200 border border-gray-300 rounded shadow">
                            {{ $foodbank->name}}<br />
                            {{ $address->address1 }}{!! $address->address1 ? '<br />' : '' !!}
                            {{ $address->address2 }}{!! $address->address2 ? '<br />' : '' !!}
                            {{ $address->address3 }}{!! $address->address3 ? '<br />' : '' !!}
                            {{ $address->address4 }}{!! $address->address4 ? '<br />' : '' !!}
                            {{ $address->postcode }}{!! $address->postcode ? '<br />' : '' !!}
                            <br />
                            <strong>Phone:</strong> {{ $address->phone_number }}<br />
                            <strong>Email:</strong> {{ $foodbank->email }}<br />
                            <strong>Hours:</strong> {{ $foodbank->hours }}<br />
                        </div>
                    </div>
                    @endforeach
                </div>

                <h3 class="my-4 text-xl font-bold">Contacts:</h3>
                    <div class="flex flex-row flex-wrap">
                    
                        @foreach($foodbank->contacts as $contact)
                        <div class="w-1/3 p-2">
                            <div class="p-4 text-sm leading-normal bg-gray-200 border border-gray-300 rounded shadow">
                                {{ $contact->title }} {{ $contact->forenames }} {{ $contact->surname }}<br />
                                @if($contact->pivot->relationship) ({{ $contact->pivot->relationship }})<br />@endif
                                @if($contact->phone1) <strong>Phone:</strong> {{ $contact->phone1 }} <br />@endif
                                @if($contact->phone2) <strong>Phone:</strong> {{ $contact->phone2 }} <br />@endif
                                @if($contact->email1) <strong>Email:</strong> {{ $contact->email1 }} <br />@endif
                                @if($contact->email2) <strong>Email:</strong> {{ $contact->email2 }} <br />@endif
                            </div>
                        </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
</div>