@extends('layouts.layout')

@section('title', $pages->title)

@section('content')
    <div>
        @if($pages->blocks[0]->active)
            <x-block-renderer :pages="$pages"/>
{{--             shop --}}
        @else
            {{-- shop --}}
            <x-block-renderer :pages="$pages"/>
        @endif
    </div>
@stop
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family={{$pages->header_font}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family={{$pages->body_font}}">

<?php
    $primary = $pages->primary_color !== null ? $pages->primary_color : '#fbbf24';
    $secondary = $pages->secondary_color !== null ? $pages->secondary_color : '#fbbf24';
?>

<style>
    header, footer{
        &.bg-amber-400, .lang-selector .wrapper{
            background-color: {{$primary}};
        }
    }

    a span {
        color: {{$pages->secondary}};
    }

    @if($pages->header_font !== null)
        h1, h2, h3, h4, h5, h6 {
            font-family: {{$pages->header_font}};
        }
        h2, h3, h4, h5, h6 {
            color: {{$pages->primary_color}}
        }
    @endif
    @if($pages->body_font !== null)
        * {
            font-family: {{$pages->body_font}}
        }
    @endif
</style>
