<div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
        {{ __('Login') }}
    </div>

    <form class="w-full p-6" method="POST" 
        @if($this->state==='passwordless')
            action="{{ route('passwordless.login') }}"
        @else
            'action="{{ route('login') }}"
        @endif
    >
        @csrf

        <div class="flex flex-wrap mb-6">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                {{ __('E-Mail Address') }}:
            </label>

            <input id="email" type="email" wire:model.debounce.300ms="email" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>

        @if($this->state==='password')

            <div class="flex flex-wrap mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('Password') }}:
                </label>

                <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" name="password" required>

                @error('password')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        @endif

        <div class="flex mb-6">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="text-sm text-gray-700 ml-3" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>

        <div class="flex flex-wrap items-center">
            @if($this->state==='unverified')  
                <button type="submit" disabled
                    class="opacity-50 cursor-not-allowed bg-blue-500 text-gray-100 font-bold py-2 px-4 rounded">
                    {{ __('Next')}}
                </button>
            @endif

            @if($this->state==='passwordless')  
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ __('Next')}}
                </button>
            @endif

            @if($this->state==='password')
                <button type="submit" 
                class="bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-500 hover:text-blue-700 whitespace-no-wrap no-underline ml-auto" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            @endif

        </div>
    </form>

</div>
