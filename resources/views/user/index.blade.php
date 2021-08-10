@extends('layouts.user')

@section('styles')
@endsection

@section('scripts')
    <script>
        function previewAvatarImg() {
            previewAvatar.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

@endsection
@section('contents')
    <!-- Content  -->
    <!-- Toolbar-->
    <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
        <h6></h6><a class="btn btn-primary btn-sm btn-sm" href="#"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                class="ci-sign-out me-2"></i>Sign
            out</a>
    </div>
    <!-- Profile form-->
    <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
        <h2 class="h3 py-2 text-center text-sm-start">Settings</h2>
        <!-- Tabs-->
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="nav-item"><a class="nav-link px-0 active" href="#profile_update_div" data-bs-toggle="tab" role="tab">
                    <div class="d-none d-lg-block"><i class="ci-user opacity-60 me-2"></i>Profile</div>
                    <div class="d-lg-none text-center"><i class="ci-user opacity-60 d-block fs-xl mb-2"></i><span
                            class="fs-ms">Profile</span>
                    </div>
                </a></li>
            <li class="nav-item"><a class="nav-link px-0" href="#password_update_div" data-bs-toggle="tab" role="tab">
                    <div class="d-none d-lg-block"><i class="ci-locked opacity-60 me-2"></i>Password
                    </div>
                    <div class="d-lg-none text-center"><i class="ci-locked opacity-60 d-block fs-xl mb-2"></i><span
                            class="fs-ms">Password</span></div>
                </a></li>
        </ul>
        <!-- Tab content-->
        <div class="tab-content">
            <!-- Profile-->
            <div class="tab-pane fade show active" id="profile_update_div" role="tabpanel">
                <div class="card mb-4 px-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.updateAvatar') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="bg-secondary rounded-3 p-4 mb-4">
                                <div class="d-flex align-items-center"><img class="rounded-circle cus-avatar-preview"
                                        id="previewAvatar" src="/storage/usercontents/avatars/{{ Auth::user()->avatar }}"
                                        width="90" alt="Susan Gardner">
                                    <div class="ps-3">
                                        <label for="avatar" class="btn btn-light btn-shadow btn-sm mb-2" type="button"><i
                                                class="ci-loading me-2"></i>Change avatar</label>
                                        <div class="p mb-0 fs-ms text-muted">Upload JPG, or PNG image. Min 300 x
                                            300
                                            is preferred.
                                        </div>
                                        <input class="form-control d-none" type="file" id="avatar" name="avatar"
                                            onchange="previewAvatarImg()">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm mt-3 mt-sm-0" type="submit">Update
                                Avatar</button>
                        </form>
                    </div>
                </div>
                <div class="card mb-4 px-3">
                    <div class="card-body">
                        <form action="{{ route('user.updateProfileName') }}" method="POST">
                            @csrf
                            <div class="row gx-4 gy-3">
                                <div class="col-12">
                                    <label class="form-label" for="name">Name</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                        value="{{ $data['user']->name }}">
                                </div>
                                <div class="col-12">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">

                                        <button class="btn btn-primary btn-sm mt-3 mt-sm-0" type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-4 px-3">
                    <div class="card-body">
                        <form action="{{ route('user.updateProfileUsername') }}" method="POST">
                            @csrf
                            <div class="row gx-4 gy-3">
                                <div class="col-12">
                                    <label class="form-label" for="username">Username</label>
                                    <input class="form-control" type="text" id="username" name="username"
                                        value="{{ $data['user']->username }}">
                                </div>
                                <div class="col-12">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">

                                        <button class="btn btn-primary btn-sm mt-3 mt-sm-0" type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-4 px-3">
                    <div class="card-body">
                        <form action="{{ route('user.updateProfilePhone') }}" method="POST">
                            @csrf
                            <div class="row gx-4 gy-3">

                                <div class="col-12">
                                    <label class="form-label" for="account-phone">Phone Number</label>
                                    <input class="form-control" type="text" id="account-phone" name="phone"
                                        value="{{ $data['user']->phone }}">
                                </div>
                                <div class="col-12">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">

                                        <button class="btn btn-primary btn-sm mt-3 mt-sm-0" type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Password Update-->
            <div class="tab-pane fade" id="password_update_div" role="tabpanel">
                <div class="card mb-4 px-3">
                    <div class="card-body">
                        <form action="{{ route('user.changeUserPassword') }}" method="POST">
                            @csrf
                            <div class="row gx-4 gy-3">
                                <div class="col-12">
                                    <label class="form-label" for="newPassword">New Password</label>
                                    <div class="password-toggle">
                                        <input class="form-control" type="password" id="newPassword" name="newPassword">
                                        <label class="password-toggle-btn" aria-label="Show/hide password">
                                            <input class="password-toggle-check" type="checkbox" tabindex="-1"><span
                                                class="password-toggle-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="newPassword_confirmation">Confirm New
                                        Password</label>
                                    <div class="password-toggle">
                                        <input class="form-control" type="password" id="newPassword_confirmation"
                                            name="newPassword_confirmation">
                                        <label class="password-toggle-btn" aria-label="Show/hide password">
                                            <input class="password-toggle-check" type="checkbox" tabindex="-1"><span
                                                class="password-toggle-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-sm">Change
                                        Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-4 px-3">
                    <div class="card-body">

                        <div class="accordion" id="learn-more-about-2FA">

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="learn-more-button">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#learn-more-content" aria-expanded="false"
                                        aria-controls="learn-more-content">Learn More
                                        about
                                        2FA.</button>
                                </h2>
                                <div class="accordion-collapse collapse" id="learn-more-content"
                                    aria-labelledby="learn-more-button" data-bs-parent="#learn-more-about-2FA">
                                    <div class="accordion-body">
                                        <p>Two factor authentication (2FA) strengthens access security by
                                            requiring two methods (also referred to as factors) to verify your
                                            identity. Two factor authentication protects against phishing,
                                            social engineering and password brute force attacks and secures your
                                            logins from attackers exploiting weak or stolen credentials.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>


                        @if ($data['user']->twoFactorAuth == null)
                            <div class="alert alert-danger">
                                2FA is currently <strong>disabled</strong> on your account.
                            </div>
                            <form class="form-horizontal" method="POST" action="{{ route('generate2faSecret') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Enable 2FA
                                    </button>
                                </div>
                            </form>
                        @elseif(!$data['user']->twoFactorAuth->google2fa_enable)
                            <div class="alert alert-danger">
                                2FA is currently <strong>disabled</strong> on your account.
                            </div>
                            1. Scan this QR code with your Google Authenticator App. Alternatively, you can use
                            the code: <strong><code>{{ $data['secret'] }}</code></strong><br />
                            <img src="{{ $data['google2fa_url'] }}" alt="">
                            <br /><br />
                            2. Enter the pin from your Authenticator app:<br /><br />
                            <form class="form-horizontal" method="POST" action="{{ route('enable2fa') }}">
                                {{ csrf_field() }}
                                <div class="row gx-4 gy-3">
                                    <div class="col-12">
                                        <label for="secret" class="form-label">Authenticator Code</label>
                                        <input id="secret" type="password"
                                            class="form-control col-md-4 @error('verify-code') is-invalid @enderror"
                                            name="secret" required>
                                        @error('verify-code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="text-start pt-2">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Enable 2FA
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @elseif($data['user']->twoFactorAuth->google2fa_enable)
                            <div class="alert alert-success">
                                2FA is currently <strong>enabled</strong> on your account.
                            </div>
                            <p>If you are looking to disable Two Factor Authentication. Please confirm your
                                password and Click Disable 2FA Button.</p>
                            <form method="POST" action="{{ route('disable2fa') }}">
                                {{ csrf_field() }}
                                <div class="row gx-4 gy-3">
                                    <div class="col-12">
                                        <label for="email" class="form-label">Current Password</label>
                                        <input id="current-password" type="password"
                                            class="form-control col-md-4 @error('current-password') is-invalid @enderror"
                                            name="current-password" required>
                                        @error('current-password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-start pt-2">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Disable 2FA
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
