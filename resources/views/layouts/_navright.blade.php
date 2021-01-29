<div class="items-center flex-1 text-right">
    @guest
    <a class="p-3 text-sm text-gray-300 no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
    @if (Route::has('register'))
    <a class="p-3 text-sm text-gray-300 no-underline hover:underline"
        href="{{ route('register') }}">{{ __('Register') }}</a>
    @endif
    @else

    @livewire('notifications-panel')
       
    <div class="relative inline-block" x-data="{open:false}" >
        <button x-on:click="open = !open" x-on:click.away="open=false"
            class="flex items-center py-2 pl-3 pr-1 text-gray-300 cursor-pointer focus:outline-none hover:text-white">
            {{ Auth::user()->name }}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" :class="{'rotate-180': open}"
                class="inline-block w-6 h-6 ml-1 text-gray-500 duration-300 transform fill-current">
                <path fill-rule="evenodd"
                    d="M15.3 10.3a1 1 0 011.4 1.4l-4 4a1 1 0 01-1.4 0l-4-4a1 1 0 011.4-1.4l3.3 3.29 3.3-3.3z" />
            </svg>
        </button>
        <ul x-show="open" x-cloak class="absolute right-0 w-64 space-y-1 text-right text-indigo-600 origin-top bg-white rounded shadow-lg"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-y-50"
            x-transition:enter-end="opacity-100 transform scale-y-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-end="opacity-0 transform scale-y-50"
        >
            @can('Subscriptions.edit')
                <li><a href="{{ route('alertSubscriptions.index') }}" class="block w-full px-5 py-2 text-left text-gray-800 rounded hover:bg-teal-300"><x-svg.bell class="h-4 text-teal-700 align-top" />Alert&nbsp;Subscriptions</a></li>
            @endcan
            <li><a href="{{ route('logout') }}" class="block w-full px-5 py-2 text-left text-gray-800 rounded hover:bg-teal-300" 
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"><x-svg.logout class="h-4 text-teal-700 align-top" />{{ __('Logout') }}</a>
            </li>
        </ul>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        {{ csrf_field() }}
    </form>
    @endguest
</div>