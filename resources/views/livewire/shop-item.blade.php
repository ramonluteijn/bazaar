<div wire:key="advertisement-{{ $advertisement->id }}" class="bg-white shadow-md rounded overflow-hidden mb-4 relative">
    <label class="absolute top-[25px] right-[25px] border-2 border-green-600 rounded-full w-[75px] text-center text-green-600">{{__($advertisement->type)}}</label>
    <a href="{{ route('advertisement.read-from-id', $advertisement->id) }}">
    <img src="{{ asset($advertisement->image_url) }}" alt="Advertisement Image" class="w-full h-auto">
    <div class="px-8 pt-6 pb-8 text-center">
        <h5 class="text-xl font-bold mb-2">{{ $advertisement->title }}</h5>
        <p class="text-gray-700 mb-4">{{ Str::of($advertisement->description)->words(10, '...') }}</p>
        <p class="text-gray-700 text-sm font-bold mb-4">{{ $advertisement->price }}</p>
        <div class="w-full">
            <button class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{__('View Details')}}</button>
        </div>
    </div>
    </a>
</div>
