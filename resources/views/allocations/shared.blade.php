@extends('layouts.guest',[$title='Allocation | '])

@section('content')
<style>
    [x-cloak] {
        display: none;
    }
</style>

@livewire('allocations.shared-allocations-component',['allocation' => $allocation])

@endsection