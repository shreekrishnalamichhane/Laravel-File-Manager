@extends('layouts.guest')

@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h2 class="h4 mb-1">Verify Your Email Address</h2>
                        <hr class="my-3">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form method="POST" action="{{ route('verification.resend') }}" class="needs-validation"
                            novalidate="">
                            @csrf
                            <div class="text-start pt-4">
                                <button class="btn btn-primary" type="submit"><i class="ci-sign-in me-2 ms-n21"></i>Click
                                    here to request another</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
