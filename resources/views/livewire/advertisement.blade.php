<div class="pb-[100px] min-h-[calc(100vh-50px-75px)] flex items-center justify-center">
    <div class="w-full container">
        <div class="">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/2 relative">
                        <img src="{{ asset($advertisement->image_url) }}" alt="{{ $advertisement->title }}" class="w-full max-w-[500px] max-h-[500px] object-cover mb-4 rounded-lg">
                        <img src="{{ $qrCode }}" alt="QR Code for {{ $advertisement->title }}" class="absolute top-0 right-0 w-16 h-16 m-2 rounded-lg">
                    </div>
                    <div class="md:w-1/2 md:pl-6 relative">
                        <label class="absolute top-[25px] right-[25px] border-2 border-green-600 rounded-full w-[75px] text-center text-green-600">{{$advertisement->type}}</label>
                        <h1 class="text-3xl font-bold mb-2">{{ $advertisement->title }}</h1>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xl font-semibold text-green-600">${{ $advertisement->price }}</span>
                        </div>
                        <div class="text-sm text-gray-500 mb-4">
                            <p>{{__('Posted by')}}: <a href="{{ route('user.profile', $advertisement->user->id) }}" class="text-blue-500 hover:underline">{{ $advertisement->user->name }}</a></p>
                            <p>{{__('Expires at')}}: {{ $advertisement->expires_at }}</p>
                            @if($advertisement->type === 'hire')
                                <p>{{__('Collection date')}}: {{ $advertisement->collection_date }}</p>
                                <p>{{__('Return date')}}: {{ $advertisement->return_date }}</p>
                            @endif
                        </div>
                        @auth
                            <button wire:click="addToCart({{ $advertisement->id }})" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline absolute bottom-0 w-full h-[50px]">
                                {{__('Add to cart')}}
                            </button>
                        @else
                            <a href="{{ route('login.show') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline absolute bottom-0 w-full h-[50px] text-center">
                                {{__('Add to cart')}}
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="mt-4">
                    <x-heart-wishlist :advertisement="$advertisement"/>
                </div>

                <div class="mt-6">
                    <h2 class="text-2xl font-bold mb-2">{{__('Description')}}</h2>
                    <p class="text-gray-700">{{ $advertisement->description }}</p>
                </div>
            </div>
        </div>

        <div class="mt-6 text-center">
            <h2 class="text-2xl font-bold mb-4">{{__('Related Advertisements')}}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedAdvertisements as $relatedAdvertisement)
                    @livewire('shop-item', ['advertisement' => $relatedAdvertisement], key('advertisement-'.$relatedAdvertisement->id))
                @endforeach
            </div>
        </div>

        <x-reviews.reviews :reviews="$reviews"/>
        <x-reviews.review-form :advertisement_id="$advertisement->id"/>
    </div>
</div>
