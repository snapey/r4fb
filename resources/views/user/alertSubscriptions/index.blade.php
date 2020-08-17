@extends('layouts.app',[$title='Dashboard | '])

@section('content')
<div class="flex items-center">
    <div class="w-full">

        @if (session('status'))
        <div class="px-3 py-4 mb-4 text-sm text-green-700 bg-green-100 border border-t-8 border-green-600 rounded"
            role="alert">
            {{ session('status') }}
        </div>
        @endif

        <div class="flex flex-col break-words bg-white border-2 rounded shadow-md">

            <div class="px-6 py-3 mb-0 font-semibold text-gray-700 bg-gray-200">
                Alert Subscriptions
            </div>

            <div class="w-full p-6">

                <form action="{{ route('alertSubscriptions.update') }}" method="POST" >@csrf @method('patch')
                    <table class="w-full text-gray-700">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left border-b-2 border-teal-800">Alert Description</th>
                                <th class="py-2 text-center border-b-2 border-teal-800">Email</th>
                                <th class="py-2 text-center bg-gray-200 border-b-2 border-teal-800">Digest</th>
                                <th class="py-2 text-center border-b-2 border-teal-800">In-App</th>
                            </tr>
                        </thead>
                        @foreach($events as $event => $description)
                            <tr>
                                <td class="px-4 py-2">{{ $description }}</td>
                                <td class="px-4 py-2 text-center">
                                    <input type="hidden" name="events[{{ $event }}]" />
                                    <input {{ str_contains($alerts->where('event',$event)->first()->via ?? '','email') ? 'checked':'' }} type="checkbox" name="events[{{ $event }}][email]" />
                                </td>
                                <td class="px-4 py-2 text-center bg-gray-200">
                                    <input {{ str_contains($alerts->where('event',$event)->first()->via ?? '','digest') ? 'checked':'' }} type="checkbox" name="events[{{ $event }}][digest]" />
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <input {{ str_contains($alerts->where('event',$event)->first()->via ?? '','internal') ? 'checked':'' }} type="checkbox" name="events[{{ $event }}][internal]" />
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="w-full mt-4 text-right">
                        <x-button class="px-4" active type="submit">Save Alert Subscriptions</x-button>
                    </div>
                </form>
                <div class="p-4 mt-8 bg-gray-100 border rounded shadow">
                    <span class="font-bold text-teal-800">Subscription types:</span>
                    <p class="my-2 text-gray-700"><strong class="text-gray-800">Email:</strong> You will recieve an email immediately the alert occurs. You will recieve many emails per day.</p>
                    <p class="my-2 text-gray-700"><strong class="text-gray-800">Digest:</strong> You will recieve a single email per day with a list of all the alerts created in that day.</p>
                    <p class="my-2 text-gray-700"><strong class="text-gray-800">In-App:</strong> You will see alerts within the R4FB application and notified by a bell in the header.</p>
                    <p class="my-2 italic text-gray-700">You will not receive any alerts for your own activities, eg, if <strong>you</strong> create a food bank, you will not yourself receive an alert.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection