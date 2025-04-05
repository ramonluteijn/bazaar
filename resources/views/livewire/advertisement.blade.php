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

                        @if($advertisement->type === 'bid')
                            <div id="countdown" class="text-red-600 font-bold text-lg mb-4"></div>
                            <div class="mt-6">
                                <h2 class="text-2xl font-bold mb-2">{{__('Bids')}}</h2>
                                <ul class="list-disc pl-5">
                                    @foreach($advertisement->bids as $bid)
                                        <li class="mb-2">
                                            <span class="font-semibold">{{ \Carbon\Carbon::parse($bid->created_at)->format('Y-m-d H:i') }}</span>: ${{ $bid->amount }}                                </li>
                                    @endforeach
                                </ul>
                            </div>
                            <form method="POST" action="{{ auth()->check() ? route('advertisements.bid', ['advertisement' => $advertisement->id]) : route('login.show') }}" class="absolute bottom-0 w-full flex items-center justify-between p-4 bg-gray-100 rounded-lg shadow-md">
                                @csrf
                                <input type="hidden" name="advertisement_id" value="{{ $advertisement->id }}">
                                <x-forms.input-field type="number" name="bid_amount" label="{{__('Enter your bid')}}" value="{{ old('bid_amount') }}" class="w-3/4 py-2 px-4 rounded-l border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-600 focus:border-transparent"/>
                                @if(auth()->check())
                                    <button type="submit" class="w-1/4 py-2 px-4 bg-yellow-600 hover:bg-yellow-700 text-white font-bold rounded-r focus:outline-none focus:ring-2 focus:ring-yellow-600 focus:ring-opacity-50">
                                        {{__('Place a bid')}}
                                    </button>
                                @else
                                    <button type="button" onclick="window.location.href='{{ route('login.show') }}'" class="w-1/4 py-2 px-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-r focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50">
                                        {{__('Login to bid')}}
                                    </button>
                                @endif
                            </form>
                        @else
                            <button onclick="window.location.href='{{ auth()->check() ? '#' : route('login.show') }}'" wire:click="{{ auth()->check() ? 'addToCart(' . $advertisement->id . ')' : '' }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline absolute bottom-0 w-full h-[50px]">
                                {{__('Add to cart')}}
                            </button>
                        @endif
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

        @if($relatedAdvertisements->count() >0 )
            <div class="mt-6 text-center">
                <h2 class="text-2xl font-bold mb-4">{{__('Related Advertisements')}}</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedAdvertisements as $relatedAdvertisement)
                        @livewire('shop-item', ['advertisement' => $relatedAdvertisement], key('advertisement-'.$relatedAdvertisement->id))
                    @endforeach
                </div>
            </div>
        @endif

        <x-reviews.reviews :reviews="$reviews"/>
        <x-reviews.review-form :advertisement_id="$advertisement->id"/>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const expiresAt = new Date("{{ $advertisement->expires_at }}").getTime();
        const countdownElement = document.getElementById('countdown');

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = expiresAt - now;

            if (distance < 0) {
                countdownElement.innerHTML = "{{ __('Expired') }}";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownElement.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }

        setInterval(updateCountdown, 1000);
    });
</script>
