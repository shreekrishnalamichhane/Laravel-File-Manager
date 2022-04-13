<?php

namespace App\Http\Controllers;

use App\Models\TwoFactorAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class TwoFactorAuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show 2FA Setting form
     */
    public function show2faForm(Request $request)
    {
        $user          = Auth::user();
        $google2fa_url = "";
        $secret_key    = "";

        if ($user->twoFactorAuth()->exists()) {
            $google2fa     = (new \PragmaRX\Google2FAQRCode\Google2FA());
            $google2fa_url = $google2fa->getQRCodeInline(
                env('APP_NAME'),
                $user->email,
                $user->twoFactorAuth->google2fa_secret
            );
            $secret_key = $user->twoFactorAuth->google2fa_secret;
        }

        $data = array(
            'user'          => $user,
            'secret'        => $secret_key,
            'google2fa_url' => $google2fa_url,
        );

        return view('auth.2fa_settings')->with('data', $data);
    }

    /**
     * Generate 2FA secret key
     */
    public function generate2faSecret(Request $request)
    {
        $user = Auth::user();
        // Initialise the 2FA class
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        // Add the secret key to the registration data
        $login_security                   = TwoFactorAuth::firstOrNew(array('user_id' => $user->id));
        $login_security->user_id          = $user->id;
        $login_security->google2fa_enable = 0;
        $login_security->google2fa_secret = $google2fa->generateSecretKey();
        $login_security->save();

        return redirect('/profile')->with('success', "Secret key is generated.");
    }

    /**
     * Enable 2FA
     */
    public function enable2fa(Request $request)
    {
        $user      = Auth::user();
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        $secret = $request->input('secret');
        $valid  = $google2fa->verifyKey($user->twoFactorAuth->google2fa_secret, $secret);

        if ($valid) {
            $user->twoFactorAuth->google2fa_enable = 1;
            $user->twoFactorAuth->save();
            return redirect('/profile')->with('success', "2FA is enabled successfully.");
        } else {
            return redirect('/profile')->with('error', "Invalid verification Code, Please try again.");
        }
    }

    /**
     * Disable 2FA
     */
    public function disable2fa(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your password does not matches with your account password. Please try again.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
        ]);
        $user                                  = Auth::user();
        $user->twoFactorAuth->google2fa_enable = 0;
        $user->twoFactorAuth->save();
        return redirect('/profile')->with('success', "2FA is now disabled.");
    }
}
