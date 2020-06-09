@extends('layouts.app',[$title='Foodbank | '])

@section('content')
<style>
    [x-cloak] {display: none;}
</style>

    @livewire('foodbanks.foodbank-card',['id' => $id])
    
    @include('admin.foodbanks.easycopy-modal')
@endsection