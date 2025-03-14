@extends('layouts.layout')

@section('title', $advertisement->title)

@section('content')
    @livewire('advertisement', ['advertisement' => $advertisement, 'qrCode' => $qrCode, 'reviews' => $reviews,'relatedAdvertisements' => $relatedAdvertisements], key($advertisement->id))
@stop
