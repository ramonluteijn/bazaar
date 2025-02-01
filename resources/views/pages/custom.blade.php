@extends('layouts.layout')

@section('title', $pages->title)

@section('content')
    <div>
        <x-block-renderer :pages="$pages"/>
    </div>
@stop
