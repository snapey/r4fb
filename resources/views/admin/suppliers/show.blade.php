@extends('layouts.app',[$title='Supplier | '])

@section('content')

    @livewire('suppliers.supplier-card',['supplier' => $supplier])
    
@endsection