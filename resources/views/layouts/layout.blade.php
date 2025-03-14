<!doctype html>
<html>
<head>
    <title>{{config('app.name')}} | @yield('title')</title>
    @vite(['resources/js/app.js'])
</head>
@php
    if (strpos(Route::current()->getName(), '.') !== false) {
        $parts = explode('.', Route::current()->getName());
        $className = $parts[0];
    }
    else {
        $className = Route::current()->getName();
    }

    if(request()->is('*profile*')) {
        $uriName = "profile";
    }
    else {
        $uriName = "";
    }
@endphp
<body class="{{$className}} {{$uriName}}">
    <x-header />

    <main class="col-12">
        <div class="pt-[75px]">
            @yield('content')
        </div>
    </main>

    <x-footer />
</body>
</html>
