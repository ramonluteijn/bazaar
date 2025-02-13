<div class="bg-white p-6 rounded-lg shadow-lg">
    <ul class="space-y-4">
        <li>
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-gray-800 hover:bg-gray-100 rounded-lg transition duration-200">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('advertisements.index') }}" class="block px-4 py-3 text-gray-800 hover:bg-gray-100 rounded-lg transition duration-200">Advertisements</a>
        </li>
        <li>
            <a href="{{ route('contracts.index') }}" class="block px-4 py-3 text-gray-800 hover:bg-gray-100 rounded-lg transition duration-200">Contracts</a>
        </li>
        @if(Auth::user()->hasRole('owner') || Auth::user()->hasRole('admin'))
        @elseif(Auth::user()->hasRole('private_advertiser') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('owner'))
        @elseif(Auth::user()->hasRole('business_advertiser') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('owner'))
        @endif
        {{-- Uncomment the following lines if needed --}}
        {{-- <li><a href="{{ route('wishlist.show') }}" class="block px-4 py-3 text-gray-800 hover:bg-gray-100 rounded-lg transition duration-200">Wishlist</a></li> --}}
        {{-- <li><a href="{{ route('reviews.show') }}" class="block px-4 py-3 text-gray-800 hover:bg-gray-100 rounded-lg transition duration-200">Reviews</a></li> --}}
        {{-- <li><a href="{{ route('agenda.show') }}" class="block px-4 py-3 text-gray-800 hover:bg-gray-100 rounded-lg transition duration-200">Agenda</a></li> --}}
        {{-- <li><a href="{{ route('orders.show') }}" class="block px-4 py-3 text-gray-800 hover:bg-gray-100 rounded-lg transition duration-200">Orders</a></li> --}}
    </ul>
</div>
