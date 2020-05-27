@extends('layouts.app',[$title='Shipper | '])

@section('content')

    @livewire('shippers.shipper-component',['shipper' => $shipper])
    
@endsection