@extends('layouts.app',[$title='Manage Email Templates | '])

@section('content')

<div class="container mx-auto text-sm text-gray-700">
    <h1 class="mx-6 my-2 text-2xl font-bold text-teal-800 ">Email Template</h1>
    <div class="flex w-full p-6">
        @if($template->exists)
            <form class="flex flex-col w-full" method="POST" action="{{ route('admin.templates.update',$template) }}">
            @method('put')
        @else
            <form class="flex flex-col w-full" method="POST" action="{{ route('admin.templates.store') }}">
        @endif
            @csrf
            <div class="flex w-full">

                {{-- form input element --}}
                <div class="flex flex-wrap w-1/3 mb-6">
                    <label for="title" class="block mb-2 text-sm font-bold text-gray-700">Template title:</label>

                    <input id="title" type="text" required name="title" value="{{ old('title', $template->title) }}" class="text-base shadow appearance-none border rounded 
                        w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline 
                        @error('title') border-red-500 @enderror">
                    @error('title')
                    <p class="mt-4 text-xs italic text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- form input element --}}
                <div class="flex flex-wrap w-2/3 mb-6 ml-4">
                    <label for="purpose" class="block mb-2 text-sm font-bold text-gray-700">Purpose:</label>

                    <input id="purpose" type="text" name="purpose"
                        value="{{ old('purpose', $template->purpose) }}" class="text-base shadow border rounded w-full 
                        py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline 
                        @error('purpose') border-red-500 @enderror">

                    @error('purpose')
                    <p class="mt-4 text-xs italic text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex w-full">
                <div class="w-1/3">
                    <label for="context" class="block mb-2 text-sm font-bold text-gray-700">Context:</label>
                    <select class="w-full px-1 py-2 text-base leading-tight text-gray-700 border rounded shadow focus:outline-none focus:shadow-outline" name="context">
                        <option >Choose a context for this mail</option>
                        <option value="shipment" {{ old('context',$template->context) == 'shipment' ? 'selected' :''}}>Shipment</option>
                        <option value="allocation" {{ old('context',$template->context)== 'allocation' ? 'selected' :''}}>Allocation</option>
                    </select>
                    @error('context')
                        <p class="mt-4 text-xs italic text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- form input element --}}
                <div class="w-2/3 mb-6 ml-4">
                    <label for="subject" class="block mb-2 text-sm font-bold text-gray-700">Email subject line:</label>
                    <input id="subject" type="text" name="subject" value="{{ old('subject', $template->subject) }}" required
                        class="text-base shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline 
                                        @error('subject') border-red-500 @enderror">
                    @error('subject')
                        <p class="mt-4 text-xs italic text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex w-full">
                <div class="w-8/12 pr-4">
                    <label for="body" class="block mb-2 text-sm font-bold text-gray-700">Body:</label>
                    <textarea name="body" lines='20'>{{ $template->body }}</textarea>
                </div>

                <div class="w-4/12 leading-snug">
                    <h3 class="px-4 text-sm font-bold text-gray-700">Body placeholders:</h3>
                    <div class="p-4 m-2 text-gray-800 bg-gray-100 border rounded shadow">
                        <p class="mb-2">Use these tags to insert data into your email templates:</p>
                        <ul>
                            <li>[shipment] <span class="ml-2 text-gray-600">The Shipment Number</span></li>
                            <li>[foodbank] <span class="ml-2 text-gray-600">the name of the foodbank</span></li>
                            <li>[foodbanks] <span class="ml-2 text-gray-600">A bullet list of foodbank names (put in 1st column)</span></li>
                            <li>[allocations] <span class="ml-2 text-gray-600">A comma seperated list of allocation numbers</span></li>
                            <li>[to] <span class="ml-2 text-gray-600">The delivery address of a shipment</span></li>
                            <li>[from] <span class="ml-2 text-gray-600">Where the shipment is from</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <button class="positive-button" type="submit">Save </button>
        <form>
    </div>
</div>
@endsection

@section('head')

<link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
<script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>

@endsection

@section('page-js')
<script>
    var easyMDE = new EasyMDE({
        hideIcons: ["image", "quote"],
        spellChecker: false,
    });
</script>
@endsection