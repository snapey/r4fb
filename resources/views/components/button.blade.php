<button {{ $attributes->except('class') }} 
    class="py-2 text-xs font-bold text-center transition duration-150 border border-gray-500 rounded shadow {{ $attributes['class'] }}
    @if(isset($danger))
        {{ isset($active) ? 'bg-red-700 text-white hover:bg-red-600' 
            : 'bg-white text-gray-600 hover:bg-red-700 hover:text-white' }}
    @else
        {{ isset($active) ? 'bg-teal-700 text-teal-100 hover:bg-teal-600' 
            : 'bg-white text-gray-600 hover:bg-teal-700 hover:text-teal-100' }}
    @endif
    ">{{ $slot }}</button>