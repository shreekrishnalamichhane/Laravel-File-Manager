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

    <div class="page-title-overlap bg-dark pt-4">
        <div class="container-fluid d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                {!! render_breadcrumb() !!}
            </div>
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">

            </div>
        </div>
    </div>
    <div class="container-fluid pb-5 mb-2 mb-md-4 ">
        <div class="row">
            @include('partials._sidebar')
            <section class="col-lg-9">
                @yield('contents')
            </section>
        </div>
    </div>

    @include('partials._footer')

    @include('partials._scripts')
    @include('partials._messages')
    @yield('scripts')

</body>

</html>
