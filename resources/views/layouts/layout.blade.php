<!doctype html>
<html>
<head>
    <title>APP NAME | @yield('title')</title>
</head>

<body>
    <x-header />

    <div class="container">
        @yield('content')
    </div>

    <x-footer />
</body>
</html>
