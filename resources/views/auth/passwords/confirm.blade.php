@extends('layouts.guest')

@section('contents')
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- <div class="card">
                    <div class="card-header">{{ __('Confirm Password') }}</div>

                    <div class="card-body">
                        {{ __('Please confirm your password before continuing.') }}

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm Password') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h2 class="h4 mb-1">Confirm Password</h2>
                        <hr class="my-3">
                        <form method="POST" action="{{ route('password.confirm') }}" class="needs-validation"
                            novalidate="">
                            @csrf
                            <h6>Please confirm your password before continuing.</h6>
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
                                <button class="btn btn-primary" type="submit"><i
                                        class="ci-sign-in me-2 ms-n21"></i>Confirm</button>
                                @if (Route::has('password.request'))
                                    <a class="nav-link-inline fs-sm" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
