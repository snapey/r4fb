@if($notifications->count() > 0)
    <div class="relative inline-block" x-data="{open:false}">
        <button class="text-base tracking-tighter text-yellow-500 focus:outline-none" x-on:click="open = !open" x-on:click.away="open=false">
            <x-svg.bell class="h-5 -mr-1 align-text-top origin-top animate-swing"/>
            <sup>{{ $notifications->count() }}</sup>
        </button>

        <ul x-show="open" x-cloak
            class="absolute right-0 w-64 space-y-1 text-right text-indigo-600 origin-top bg-white rounded shadow-lg"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-y-50"
            x-transition:enter-end="opacity-100 transform scale-y-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-end="opacity-0 transform scale-y-50">

            @foreach($notifications as $noti)
            <li><a href=""
                class="block w-full px-2 py-2 text-sm text-left text-gray-800 rounded hover:bg-teal-300">
            {{ $noti->data['described'] }}: {{ $noti->data['entityName']}} <span class="text-xs text-gray-600 font-italic">({{ $noti->created_at->diffForHumans() }})</span></a></li>
            @endforeach
        </ul>


    </div>
@endif