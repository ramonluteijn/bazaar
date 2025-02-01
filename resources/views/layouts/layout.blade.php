<!doctype html>
<html>
<head>
    <title>APP NAME | @yield('title')</title>
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
