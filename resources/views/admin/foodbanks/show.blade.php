@extends('layouts.app',[$title='Foodbank | '])

@section('content')

    @livewire('foodbanks.foodbank-card',['id' => $id])

@endsection