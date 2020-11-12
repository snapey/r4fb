@extends('layouts.guest',[$title='Allocation | '])

@section('content')
<style>
    [x-cloak] {
        display: none;
    }
</style>

<div class="px-8 py-2 my-16 mt-16 text-3xl text-center bg-yellow-100 border rounded shadow-lg">
    Allocation number {{ $allocation->id }} is no longer shared with you for editing
</div>

@endsection