<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials._metas')
    @yield('metas')

    @include('partials._styles')
    @yield('styles')
    @include('partials._analytics')
    @include('partials._thirdparty_scripts')
</head>

<body>
    @include('partials._modals')
    {{-- Navbar --}}
    @include('partials._nav')

    @yield('contents')

    @include('partials._footer')

    @include('partials._scripts')
    @include('partials._messages')
    @yield('scripts')

</body>

</html>
