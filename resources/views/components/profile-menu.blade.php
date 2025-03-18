<div class="bg-white p-6 rounded-lg shadow-lg">
    <ul class="space-y-4">
        <li><a href="{{ route('dashboard.show') }}" class="block px-4 py-3 {{ url()->current() == route('dashboard.show') ? 'text-blue-500 bg-gray-200' : 'text-gray-800' }} hover:bg-gray-100 rounded-lg transition duration-200">{{__('Dashboard')}}</a></li>
        <li><a href="{{ route('orders.index') }}" class="block px-4 py-3 text-gray-800 hover:bg-gray-100 rounded-lg transition duration-200">{{__('Orders')}}</a></li>
        <li><a href="{{ route('wishlist.index') }}" class="block px-4 py-3 {{ url()->current() == route('wishlist.index') ? 'text-blue-500 bg-gray-200' : 'text-gray-800' }} hover:bg-gray-100 rounded-lg transition duration-200">{{__('Wishlist')}}</a></li>
        <li><a href="{{ route('agenda.index') }}" class="block px-4 py-3 {{ url()->current() == route('agenda.index') ? 'text-blue-500 bg-gray-200' : 'text-gray-800' }} hover:bg-gray-100 rounded-lg transition duration-200">{{__('Agenda')}}</a></li>
        @if(Auth::user()->hasRole('owner') || Auth::user()->hasRole('admin'))
            <li><a href="{{ route('settings.index') }}" class="block px-4 py-3 {{ url()->current() == route('settings.index') ? 'text-blue-500 bg-gray-200' : 'text-gray-800' }} hover:bg-gray-100 rounded-lg transition duration-200">{{__('Return settings')}}</a></li>
            <li><a href="{{ route('return.index') }}" class="block px-4 py-3 {{ url()->current() == route('return.index') ? 'text-blue-500 bg-gray-200' : 'text-gray-800' }} hover:bg-gray-100 rounded-lg transition duration-200">{{__('Returns')}}</a></li>
            <li><a href="{{ route('contracts.index') }}" class="block px-4 py-3 {{ url()->current() == route('contracts.index') ? 'text-blue-500 bg-gray-200' : 'text-gray-800' }} hover:bg-gray-100 rounded-lg transition duration-200">{{__('Contracts')}}</a></li>
        @endif
        @if(Auth::user()->hasRole('private_advertiser') || Auth::user()->hasRole('business_advertiser') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('owner'))
            <li><a href="{{ route('advertisements.index') }}" class="block px-4 py-3 {{ url()->current() == route('advertisements.index') ? 'text-blue-500 bg-gray-200' : 'text-gray-800' }} hover:bg-gray-100 rounded-lg transition duration-200">{{__('Advertisements')}}</a></li>
        @endif
        @if(Auth::user()->hasRole('business_advertiser') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('owner'))
            <li><a href="{{ route('pages.show') }}" class="block px-4 py-3 {{ url()->current() == route('pages.show') ? 'text-blue-500 bg-gray-200' : 'text-gray-800' }} hover:bg-gray-100 rounded-lg transition duration-200">{{__('Custom page')}}</a></li>
        @endif
    </ul>
</div>
