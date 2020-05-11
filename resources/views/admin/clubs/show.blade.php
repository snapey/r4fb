@extends('layouts.app',[$title='Club | '])

@section('content')

    @livewire('clubs.club-card',['club' => $club])
    
@endsection