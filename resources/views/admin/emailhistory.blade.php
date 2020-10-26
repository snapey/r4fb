@extends('layouts.app',[$title='Review Sent Email | '])

@section('content')

<div class="container mx-auto text-sm text-gray-700" x-data="{ effectivePermissions: false }">
    <div class="flex items-center justify-between w-full">
        <h1 class="px-4 text-2xl font-bold">Email History</h1>
    </div>

    <p class="mt-4 ml-4">Click on a row to see the full text</p>
    
    <table class="w-full mt-4 text-xs bg-white border shadow-lg table-fixed">
        <thead>
            <tr class="border-b">
                <th class="w-2/12 p-2 text-left">Recipient</th>
                <th class="w-3/12 p-2 text-left">Subject</th>
                <th class="w-3/12 p-2 text-left">Body</th>
                <th class="w-2/12 p-2 text-left">Queued</th>
                <th class="w-1/12 p-2 text-center">PDF</th>
                <th class="w-1/12 p-2 text-left">By</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emails as $email)
            <tr class="align-top {{ $loop->index %2==0 ? 'bg-teal-500 bg-opacity-10' :'' }} align-center" x-data="{open: false}" x-on:click="open = !open">

                <td class="px-2">{{ $email->recipient }}</td>
                <td class="px-2 cursor-pointer">
                    <span x-show="!open">{{ $email->shortsubject }}</span>
                    <span x-show="open">{{ $email->subject }}</span>
                </td>
                <td class="px-2 cursor-pointer">
                    <span x-show="!open">{{ $email->shortbody }}</span>
                    <span x-show="open">{!! $email->markedbody !!}</span>
                </td>
                <td class="px-2">{{ $email->queued_at }}</td>
            <td class="px-2 text-center"><a href="{{ $email->pdf }}" target="_blank"><svg  class="inline-block h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg></a></td>
                <td class="px-2">{{ $email->user->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection