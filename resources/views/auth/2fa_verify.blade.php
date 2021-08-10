@extends('layouts.guest')
@section('contents')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8 ">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Two Factor Authentication</h2>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif

                        Enter the pin from Google Authenticator app:<br /><br />
                        <form class="" action="{{ route('2faVerify') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row gx-4 gy-3">
                                <div class="col-12">
                                    <label for="email" class="form-label">One Time Password</label>
                                    <input id="one_time_password" name="one_time_password" class="form-control" type="text"
                                        required />
                                    @error('one_time_password-code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                            <div class="text-start pt-2">
                                <button class="btn btn-primary btn-sm" type="submit">Authenticate</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
