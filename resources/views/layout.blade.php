<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    @stack('styles')
</head>
<body>
    @include('header')

    <main>
        @yield('content')
    </main>

    @include('footer')

    @stack('scripts')
</body>
</html>
