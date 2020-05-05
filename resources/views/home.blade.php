@extends('layouts.app',[$title='Dashboard | '])

@section('content')
    <div class="flex items-center">
        <div class="w-full">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

                <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                    Dashboard
                </div>

                <div class="w-full p-6">

                    <div class="flex mb-4">
                        {{-- @livewire('dashboard-tasks',['offset' =>0])
                        @livewire('dashboard-events',['offset' =>0])
                        @livewire('dashboard-checks',['offset' =>0]) --}}
                    </div>

                    <div class="flex mb-4">
                        {{-- @livewire('dashboard-tasks',['offset' =>1])
                        @livewire('dashboard-events',['offset' =>1])
                        @livewire('dashboard-checks',['offset' =>1]) --}}
                    </div>

                    <div class="flex mb-4">
                        {{-- @livewire('dashboard-tasks',['offset' =>2])
                        @livewire('dashboard-events',['offset' =>2])
                        @livewire('dashboard-checks',['offset' =>2]) --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
