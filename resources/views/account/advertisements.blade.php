@extends('layouts.layout')

@section('title', 'Advertisements')

@section('content')
    <div>
        <h1>Advertisements</h1>
        @foreach($advertisements as $advertisement)
            <a href="{{route('advertisement.show', ['id' => $advertisement->id])}}">
                <div class="card">
                    <div class="card-body">
deded
                    </div>
                </div>
            </a>
        @endforeach

    </div>
@stop
