@extends('layouts.app',[$title='Foodbank | '])

@section('content')
<style>
    [x-cloak] {display: none;}
</style>

    @livewire('foodbanks.foodbank-card',['id' => $foodbank->id])
    
    @livewire('easycopy.foodbank', ['foodbank' => $foodbank])

@endsection