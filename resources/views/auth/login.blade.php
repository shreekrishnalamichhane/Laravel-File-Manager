@extends('layouts.guest')

@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h2 class="h4 mb-1 pb-2">Sign in</h2>
                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <div class="password-toggle">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <label class="password-toggle-btn" aria-label="Show/hide password">
                                        <input class="password-toggle-check" type="checkbox">
                                        <span class="password-toggle-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <div>
                                    @if (Route::has('password.request'))
                                        <a class="nav-link-inline fs-sm" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                    <br>
                                    @if (Route::has('register'))
                                        <a class="nav-link-inline fs-sm" href="{{ route('register') }}">
                                            {{ __('Create a New Account.') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <hr class="mt-4">
                            <div class="text-start pt-4">
                                <button class="btn btn-primary" type="submit"><i class="ci-sign-in me-2 ms-n21"></i>Sign
                                    In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
