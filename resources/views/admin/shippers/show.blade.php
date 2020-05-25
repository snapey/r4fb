@extends('layouts.app',[$title='Shipper | '])

@section('content')

    @livewire('shippers.shipper-card',['shipper' => $shipper])
    
@endsection