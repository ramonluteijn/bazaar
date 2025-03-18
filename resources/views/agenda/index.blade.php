@extends('layouts.layout')

@section('title', __('Agenda'))

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/4 p-4">
                <x-profile-menu />
            </div>
            <div class="w-full md:w-3/4 p-4">
                <h1 class="text-2xl font-bold mb-4">{{__('Your Agenda')}}</h1>

                <form method="GET" action="{{ route(Route::currentRouteName()) }}" class="mb-5" onchange="this.form.submit()">
                     <x-forms.input-select :onchange="'this.form.submit()'" label="{{__('Agenda')}}" name="selectTable" :list="$tables" value="{{ request('selectTable') }}"/>
                </form>

                @if($orders)
                    <h3 class="font-bold">{{__('My orders')}}</h3>
                    <div class="overflow-x-auto mb-5">
                        <table class="min-w-full bg-white">
                            <thead>
                            <tr class="text-left">
                                <th class="py-2 px-4 border-b">{{__('Order ID')}}</th>
                                <th class="py-2 px-4 border-b">{{__('Advertisement Title')}}</th>
                                <th class="py-2 px-4 border-b">{{__('Order Date')}}</th>
                                <th class="py-2 px-4 border-b">{{__('Collection Date')}}</th>
                                <th class="py-2 px-4 border-b">{{__('Return Date')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                @foreach($order->orderDetails as $orderDetail)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $order->id }}</td>
                                        <td class="py-2 px-4 border-b">{{ $orderDetail->advertisement->title }}</td>
                                        <td class="py-2 px-4 border-b">{{ $order->created_at }}</td>
                                        <td class="py-2 px-4 border-b">{{ $orderDetail->advertisement->collection_date }}</td>
                                        <td class="py-2 px-4 border-b">{{ $orderDetail->advertisement->return_date }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">{{ $orders->withQueryString()->links() }}</div>
                    </div>
                @endif
                @if($advertisements)
                    <h3 class="font-bold">{{__('My advertisements')}}</h3>
                    <form method="GET" action="{{ route(Route::currentRouteName()) }}" class="mb-5" onchange="this.form.submit()">
                        <x-forms.input-select :onchange="'this.form.submit()'" label="{{__('type')}}"  name="selectType" :list="$types" value="{{ request('selectType') }}"/>
                        <input type="hidden" name="selectTable" value="{{ request('selectTable') }}">
                    </form>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                            <tr class="text-left">
                                <th class="py-2 px-4 border-b">{{__('Advertisement Title')}}</th>
                                <th class="py-2 px-4 border-b">{{__('Type')}}</th>
                                <th class="py-2 px-4 border-b">{{__('Created Date')}}</th>
                                <th class="py-2 px-4 border-b">{{__('Expiration Date')}}</th>
                                @if(request('selectType') == 'hire' || request('selectType') == '')
                                    <th class="py-2 px-4 border-b">{{__('Collection Date')}}</th>
                                    <th class="py-2 px-4 border-b">{{__('Return Date')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($advertisements as $advertisement)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $advertisement->title }}</td>
                                    <td class="py-2 px-4 border-b">{{ $advertisement->type }}</td>
                                    <td class="py-2 px-4 border-b">{{ $advertisement->created_at }}</td>
                                    <td class="py-2 px-4 border-b">{{ $advertisement->expires_at }}</td>
                                    @if($advertisement->type == 'hire' || request('selectType') == '')
                                        <td class="py-2 px-4 border-b">{{ $advertisement->collection_date }}</td>
                                        <td class="py-2 px-4 border-b">{{ $advertisement->return_date }}</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">{{ $advertisements->withQueryString()->links() }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
