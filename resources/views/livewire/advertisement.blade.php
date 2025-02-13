<div class="pb-[100px] min-h-[calc(100vh-50px-75px)] flex items-center justify-center">
    <div class="w-full container">
        <div class="p-4">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/2 relative">
                        <img src="{{ asset($advertisement->image_url) }}" alt="{{ $advertisement->title }}" class="w-full max-w-[500px] max-h-[500px] object-cover mb-4 rounded-lg">
                        <img src="{{ $qrCode }}" alt="QR Code for {{ $advertisement->title }}" class="absolute top-0 right-0 w-16 h-16 m-2 rounded-lg">
                    </div>
                    <div class="md:w-1/2 md:pl-6">
                        <h1 class="text-3xl font-bold mb-2">{{ $advertisement->title }}</h1>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xl font-semibold text-green-600">${{ $advertisement->price }}</span>
                            <span class="text-sm text-gray-500">{{ $advertisement->type }}</span>
                        </div>
                        <div class="text-sm text-gray-500 mb-4">
                            <p>Posted by: {{ $advertisement->user->name }}</p>
                            <p>Expires at: {{ $advertisement->expires_at }}</p>
                        </div>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">Contact Seller</button>
                    </div>
                </div>
                <div class="mt-6">
                    <h2 class="text-2xl font-bold mb-2">Description</h2>
                    <p class="text-gray-700">{{ $advertisement->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
