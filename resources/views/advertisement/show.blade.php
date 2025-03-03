@extends('layouts.layout')

@section('title', $advertisement->title)

@section('content')
    @livewire('advertisement', ['advertisement' => $advertisement, 'qrCode' => $qrCode, 'relatedAdvertisements' => $relatedAdvertisements], key($advertisement->id))
@stop
