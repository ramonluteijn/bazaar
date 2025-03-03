@extends('layouts.layout')

@section('title', 'Settings')

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/4 p-4">
                <x-profile-menu />
            </div>
            <div class="w-full md:w-3/4 p-4">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-left">Name</th>
                        <th class="py-2 px-4 text-left">Email</th>
                        <th class="py-2 px-4 text-left">Title</th>
                        <th class="py-2 px-4 text-left">Wear</th>
                        <th class="py-2 px-4 text-left">Image</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($return as $item)
                        <tr class="border-b">
                            <td class="py-2 px-4">{{ $item->name }}</td>
                            <td class="py-2 px-4">
                                <a href="mailto:{{ $item->email }}" class="text-blue-500 hover:text-blue-700">{{ $item->email }}</a>
                            </td>
                            <td class="py-2 px-4">{{ $item->title }}</td>
                            <td class="py-2 px-4">{{ $item->wear }}%</td>
                            <td class="py-2 px-4">
                                <a href="{{ asset('storage/'.$item->image) }}" target="_blank" class="text-blue-500 hover:text-blue-700">
                                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="w-10 h-10 object-cover rounded-full">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
