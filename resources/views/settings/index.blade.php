@extends('layouts.layout')

@section('title', __('Settings'))

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/4 p-4">
                <x-profile-menu />
            </div>
            <div class="w-full md:w-3/4 p-4">
                <h1 class="text-2xl font-bold mb-4">{{__('Settings')}}</h1>
                <a href="{{ route('settings.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">{{__('Add new setting')}}</a>
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-left">{{__('Name')}}</th>
                        <th class="py-2 px-4 text-left">{{__('Percentage')}}</th>
                        <th class="py-2 px-4 text-left">{{__('Actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($settings as $setting)
                        <tr class="border-b">
                            <td class="py-2 px-4">{{ $setting->name }}</td>
                            <td class="py-2 px-4">{{ $setting->percentage }}%</td>
                            <td class="py-2 px-4">
                                <a href="{{ route('settings.show', ['id' => $setting->id]) }}" class="text-blue-500 hover:text-blue-700">{{__('Update')}}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
