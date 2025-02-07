@extends('layouts.layout')

@section('title', 'Advertisement')

@section('content')
    @livewire('advertisement-form', ['advertisementObject' => $advertisement, 'typesObject' => $types])
@stop
