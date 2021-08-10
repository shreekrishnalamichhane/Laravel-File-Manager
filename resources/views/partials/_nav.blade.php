<header class="navbar-sticky ">
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container"><a class="navbar-brand d-none d-sm-block me-4 order-lg-1"
                href="/">{{ env('APP_NAME', 'File Drive') }}</a><a class="navbar-brand d-sm-none me-2 order-lg-1"
                href="/"><img src="img/logo-icon.png" width="74" alt="Laravel"></a>
            <div class="navbar-toolbar d-flex align-items-center order-lg-3 gap-2">
                @if (Route::has('login'))
                    @auth
                        <a href="/" class="blog-entry-author-ava nav-item" style="height: 3rem;">
                            <img class=" cus-navbar-avatar" src="/storage/usercontents/avatars/{{ Auth::user()->avatar }}"
                                alt="{{ Auth::user()->name }}">
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline btn btn-primary gap-2">Log
                            in</a>


                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 text-sm text-gray-700 underline btn btn-accent">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>

    {{-- <div class="search-box collapse" id="searchBox">
        <div class="card pt-2 pb-4 border-0 rounded-0">
            <div class="container">
                <div class="input-group"><i
                        class="ci-search position-absolute top-50 start-0 translate-middle-y text-muted fs-base ms-3"></i>
                    <input class="form-control rounded-start" type="text" placeholder="This search is not functioning.">
                </div>
            </div>
        </div>
    </div> --}}
</header>
