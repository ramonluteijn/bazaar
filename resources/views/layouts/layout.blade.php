<!doctype html>
<html>
<head>
    <title>{{config('app.name')}} | @yield('title')</title>
    @vite(['resources/js/app.js'])
</head>

<body>
    <x-header />

    <main class="col-12">
        @yield('content')
    </main>

    <x-footer />
</body>
</html>
