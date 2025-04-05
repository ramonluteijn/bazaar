@extends('layouts.layout')

@section('title', $advertisement->title ?? __('Advertisement'))

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/4 p-4">
                <x-profile-menu />
            </div>
            <div class="w-full md:w-3/4 p-4">
                <h1 class="text-2xl font-bold mb-4">{{__("Advertisement")}}</h1>
                @if(isset($advertisement))
                    <form method="POST" action="{{ route('advertisements.update', ['id' => $advertisement->id]) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        @method('PUT')
                        @csrf
                        @else
                            <form method="POST" action="{{ route('advertisements.store') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                @csrf
                                @endif
                                <x-forms.input-field type="text" name="title" label="{{__('title')}}" :required="true" value="{{ old('title',$advertisement->title ?? '' )}}"/>
                                <x-forms.input-textarea name="description" label="{{__('description')}}" :class="'min-h-[100px] max-h-[300px]'">{{ old('description',$advertisement->description ?? '' )}}</x-forms.input-textarea>
                                <x-forms.input-field type="number" name="price" label="{{__('price')}}" :required="true" value="{{ old('price',$advertisement->price ?? '' )}}"/>
                                <div id="buyout_price_container" style="display: none;">
                                    <x-forms.input-field type="number" name="buyout_price" label="{{__('buyout price')}}" value="{{ old('buyout_price',$advertisement->buyout_price ?? '' )}}"/>
                                </div>
                                <x-forms.input-select id="type" name="type" :required="true" label="{{__('type')}}" :list="$types" value="{{ old('type',$advertisement->type ?? '' )}}"/>
                                <x-forms.input-field type="date" name="expires_at" label="{{__('expires at')}}" :required="true" value="{{ old('expires_at',$advertisement->expires_at ?? '' )}}"/>
                                <div id="collection_date_container" style="display: none;">
                                    <x-forms.input-field type="date" name="collection_date" label="{{__('collection date')}}" value="{{ old('collection_date',$advertisement->collection_date ?? '' )}}"/>
                                </div>
                                <div id="return_date_container" style="display: none;">
                                    <x-forms.input-field type="date" name="return_date" label="{{__('return date')}}" value="{{ old('return_date',$advertisement->return_date ?? '' )}}"/>
                                </div>
                                <div id="auction_ends_at_container" style="display: none;">
                                    <x-forms.input-select name="auction_ends_at_select" label="{{__('auction ends at')}}" :list="['3hr' => '3 hours', '8hr' => '8 hours', '12hr' => '12 hours', '24hr' => '24 hours', '48hr' => '48 hours', '72hr' => '72 hours']" value="{{ old('auction_ends_at_select') }}"/>
                                </div>
                                <x-forms.input-file name="image" :title="($advertisement->title ?? '')" label="{{__('image')}}" value="{{ $advertisement->image ?? '' }}"/>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ isset($advertisement) ? __('Update advertisement') : __('Add advertisement') }}</button>
                            </form>
                            @if(isset($advertisement))
                                <form method="POST" action="{{ route('advertisements.delete', ['id' => $advertisement->id]) }}" class="mt-4">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{__('Delete advertisement')}}</button>
                                </form>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('type');
            const buyoutPriceContainer = document.getElementById('buyout_price_container');
            const auctionEndsAtContainer = document.getElementById('auction_ends_at_container');
            const collectionDateContainer = document.getElementById('collection_date_container');
            const returnDateContainer = document.getElementById('return_date_container');
            const auctionEndsAtSelect = document.querySelector('select[name="auction_ends_at_select"]');
            const expiresAtField = document.querySelector('input[name="expires_at"]');

            function clearFields() {
                document.querySelector('input[name="buyout_price"]').value = '';
                auctionEndsAtSelect.value = '';
                document.querySelector('input[name="collection_date"]').value = '';
                document.querySelector('input[name="return_date"]').value = '';
                expiresAtField.value = '';
            }

            function toggleFields() {
                if (typeSelect.value === 'bid') {
                    buyoutPriceContainer.style.display = 'block';
                    auctionEndsAtContainer.style.display = 'block';
                    expiresAtField.parentElement.style.display = 'none';
                    collectionDateContainer.style.display = 'none';
                    returnDateContainer.style.display = 'none';
                } else if (typeSelect.value === 'hire') {
                    buyoutPriceContainer.style.display = 'none';
                    auctionEndsAtContainer.style.display = 'none';
                    expiresAtField.parentElement.style.display = 'block';
                    collectionDateContainer.style.display = 'block';
                    returnDateContainer.style.display = 'block';
                } else {
                    buyoutPriceContainer.style.display = 'none';
                    auctionEndsAtContainer.style.display = 'none';
                    expiresAtField.parentElement.style.display = 'block';
                    collectionDateContainer.style.display = 'none';
                    returnDateContainer.style.display = 'none';
                }
                clearFields();
            }

            function setAuctionEndsAtDate() {
                const now = new Date();
                let hoursToAdd = 0;

                switch (auctionEndsAtSelect.value) {
                    case '3hr':
                        hoursToAdd = 3;
                        break;
                    case '8hr':
                        hoursToAdd = 8;
                        break;
                    case '12hr':
                        hoursToAdd = 12;
                        break;
                    case '24hr':
                        hoursToAdd = 24;
                        break;
                    case '48hr':
                        hoursToAdd = 48;
                        break;
                    case '72hr':
                        hoursToAdd = 72;
                        break;
                }

                if (hoursToAdd > 0) {
                    now.setHours(now.getHours() + hoursToAdd);
                    const year = now.getFullYear();
                    const month = String(now.getMonth() + 1).padStart(2, '0');
                    const day = String(now.getDate()).padStart(2, '0');
                    const formattedDate = `${year}-${month}-${day}`;
                    expiresAtField.value = formattedDate;
                }
            }

            typeSelect.addEventListener('change', toggleFields);
            auctionEndsAtSelect.addEventListener('change', setAuctionEndsAtDate);

            // Initial check
            toggleFields();
        });
    </script>
@stop
