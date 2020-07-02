@extends('layouts.app',[$title='Item | '])

@section('content')
<style>
    [x-cloak] {
        display: none;
    }
</style>

@livewire('items.items-component',['item' => $item])

@endsection