@extends('layouts.app',[$title='Manage Email Templates | '])

@section('content')

<div class="container mx-auto text-sm text-gray-700" x-data="{ rowclick(id){window.location.href=`/admin/templates/` + id + `/edit`;} }" >
    <div class="flex items-center justify-between w-full">
        <h1 class="px-4 text-2xl font-bold">Email Templates</h1>
        <a href="{{ route('admin.templates.create') }}"><button class="w-48 positive-button">+ Add new Template</button></a>
    </div>
    <table class="w-full mt-4 bg-white border shadow-lg table-fixed">
        <thead>
            <tr class="border-b">
                <th class="w-2/12 p-4 text-left">Title</th>
                <th class="w-2/12 p-4 text-left">Purpose</th>
                <th class="w-2/12 p-4 text-center">Context</th>
            </tr>
        </thead>
        <tbody>
            @foreach($templates as $template)
            <tr class="{{ $loop->index %2==0 ? 'bg-teal-500 bg-opacity-10' :'' }} align-center hover:bg-yellow-200 hover:shadow">
                <td x-on:click="rowclick({{ $template->id }})" class="px-4"><a
                        class=""
                        href="{{ route('admin.templates.edit',$template) }}">{{ $template->title }}</a></td>
                <td x-on:click="rowclick({{ $template->id }})" class="px-4 py-2">{{ $template->purpose }}</td>
                <td x-on:click="rowclick({{ $template->id }})" class="px-4 py-2 text-center">{{ $template->context }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection