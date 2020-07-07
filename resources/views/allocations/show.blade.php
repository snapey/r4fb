@extends('layouts.app',[$title='Allocation | '])

@section('content')
<style>
    [x-cloak] {
        display: none;
    }
</style>

@livewire('allocations.allocations-component',['allocation' => $allocation])

@endsection