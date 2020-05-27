@extends('layouts.app',[$title='Supplier | '])

@section('content')

    @livewire('suppliers.supplier-component',['supplier' => $supplier])
    
@endsection