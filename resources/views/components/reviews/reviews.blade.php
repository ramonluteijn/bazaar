@props(['reviews'])

<div class="mt-6">
    @if($reviews->count() > 0)
        <h2 class="text-2xl font-bold mb-4">Reviews</h2>
    @endif
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($reviews as $review)
            <div class="bg-white shadow-md rounded-lg p-4 relative">
                @if(Auth::check() && (Auth::user()->hasRole('owner') || Auth::user()->hasRole('admin')))
                    <form action="{{ route('reviews.delete', ['id' => $review->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="absolute top-0 right-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="w-6 h-6 text-red-500">
                                <path fill="currentColor" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                            </svg>
                        </button>
                    </form>
                @endif
                <p class="text-gray-700">{{ $review->title }}</p>
                <p class="text-gray-700">{{ $review->content }}</p>
                <p class="text-sm text-gray-500">- {{ $review->name }}</p>
            </div>
        @endforeach
    </div>
</div>
