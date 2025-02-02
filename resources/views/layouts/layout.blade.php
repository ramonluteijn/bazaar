<!doctype html>
<html>
<head>
    <title>{{config('app.name')}} | @yield('title')</title>
    @vite(['resources/js/app.js'])
</head>

<body>
    <x-header />

    <main class="col-12">
        <div class="pt-[75px]">
            @yield('content')
        </div>
    </main>

    <x-footer />
</body>
</html>
