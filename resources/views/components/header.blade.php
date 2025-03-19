<header class="h-[75px] bg-amber-400 w-full flex items-center z-50 fixed top-0">
    <nav class="container mx-auto">
        <div class="row flex h-full items-center">
            <div class="mr-4 h-full items-center flex">
                <a href="{{route('home.index')}}" class="text-white text-4xl">{{config('app.name')}}</a>
            </div>
            <div class="items-center flex w-full">
                <ul class="list-none flex">
                    <li class="flex justify-center">
                        <a class="flex justify-center w-full text-center align-middle p-3" href="{{route('home.index')}}">
                            <span>{{__('Home')}}</span>
                        </a>
                    </li>
                    <li class="flex justify-center">
                        <a class="flex justify-center w-full text-center align-middle p-3" href="{{route('shop.index')}}">
                            <span>{{__('Shop')}}</span>
                        </a>
                    </li>
                    <li class="flex justify-center">
                        <a class="flex justify-center w-full text-center align-middle p-3" href="{{route('return.show')}}">
                            <span>{{__('Return')}}</span>
                        </a>
                    </li>
                    <li class="flex justify-center">
                        <a class="flex justify-center w-full text-center align-middle p-3" href="{{route('pages.index')}}">
                            <span>{{__('Pages')}}</span>
                        </a>
                    </li>
                    @if(auth()->check())
                        <li class="flex justify-center">
                            <a class="flex justify-center w-full text-center align-middle p-3" href="{{route('dashboard.show')}}">
                                <span>{{__('Account')}}</span>
                            </a>
                        <li class="flex justify-center">
                            <a class="flex justify-center w-full text-center align-middle p-3" href="{{route('logout')}}">
                                <span>{{__('Logout')}}</span>
                            </a>
                        </li>
                    @else
                        <li class="flex justify-center">
                            <a class="flex justify-center w-full text-center align-middle p-3" href="{{route('login.show')}}">
                                <span>{{__('Login')}}</span>
                            </a>
                        </li>
                    @endif
                </ul>
                <ul>
                    <nav class="lang-selector">
                        <div class="wrapper">
                            <ul class="w-[55px]">
                                @foreach(config('app.available_locales') as $locale => $name)
                                    <li>
                                        <a href="{{ route('change-locale', $locale) }}" class="{{ app()->getLocale() === $locale ? 'active' : '' }}">
                                            <img class="lang-flag" src="{{@asset('images/'.$locale.'.png')}}" alt="{{ $name }}">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </nav>
                </ul>

                @if(auth()->check())
                <div class="ml-auto">
                    @livewire('cart')
                </div>
               @endif

            </div>
        </div>
    </nav>
</header>
