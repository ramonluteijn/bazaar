<header class="h-[75px] bg-amber-400 w-full flex items-center z-50 fixed top-0">
    <nav class="container mx-auto">
        <div class="row flex h-full items-center">
            <div class="mr-4 h-full items-center flex">
                <a href="{{route('home')}}" class="text-white text-4xl">{{config('app_name')}}</a>
            </div>
            <div class="items-center flex w-full">
                <ul class="list-none flex">
                    <li class="flex justify-center">
                        <a class="flex justify-center w-full text-center align-middle p-3" href="{{route('home')}}">
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="flex justify-center">
                        <a class="flex justify-center w-full text-center align-middle p-3" href="{{route('login')}}">
                            <span>Login</span>
                        </a>
                    </li>
                </ul>
                <ul>
                    {{--                    icons or profile stuff--}}
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
            </div>
        </div>
    </nav>
</header>
