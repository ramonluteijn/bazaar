@extends('layouts.layout')

@section('title', __('Shop'))

@section('content')
    <div>
        <x-blocks.hero />
        <div class="container mx-auto px-4 py-8">
            <x-filters.dropdown :onchange="'this.form.submit()'" label="{{__('sorting')}}" name="selectSorting" :list="$types" value="{{ request('selectSorting') }}" :params="$bindings"/>
            <x-filters.dropdown :onchange="'this.form.submit()'" label="{{__('Type')}}" name="type" :list="$adTypes" value="{{ request('type') }}" :params="$bindings"/>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @if($advertisements->isEmpty())
                    <p>{{__('No advertisements found.')}}</p>
                @else
                    @foreach($advertisements as $advertisement)
                        @livewire('shop-item', ['advertisement' => $advertisement], key('advertisement-'.$advertisement->id))
                    @endforeach
                @endif
            </div>
            <div class="mt-4">
                {{ $advertisements->links() }}
            </div>
        </div>
    </div>
@stop
