@extends('layouts.app',[$title='Contact | '])

@section('content')

    @livewire('contacts.contact-main-card',compact('contact'))
    
@endsection