<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', '2fa', 'verified']);
    }

    public function index()
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

        return view('user.index')->with('data', $data);
        // return view('user.index')->with('user', $user);
    }
    public function updateAvatar(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|max:1999',
        ]);
        //handle file upload
        if ($request->hasFile('avatar')) {
            $user = Auth::user();
            //Get file name with extension
            $fileNameWithExt = $request->file('avatar')->getClientOriginalName();

            //Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $fileextension = $request->file('avatar')->getClientOriginalExtension();

            $fileNameToStore = md5($fileName . '_' . time()) . '.' . $fileextension;
            if ($user->avatar != 'default.jpg') {
                Storage::delete('/public/usercontents/avatars/' . $user->avatar);
            }

            $path = $request->file('avatar')->storeAs('/public/usercontents/avatars/', $fileNameToStore);

            $user->avatar = $fileNameToStore;
            $user->save();
        }
        return redirect()->back()->with('success', 'Avatar Updated Successfully.');
    }
    public function changePassword(Request $request)
    {
        $validator = $this->validate($request, [
            'newPassword' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        $user->password = Hash::make($request->get('newPassword'));
        $user->save();

        return redirect()->back()->with('success', 'Password Changed Successfully.');
    }
    public function updateProfileName(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:191'],
        ]);
        $user       = Auth::user();
        $user->name = $request->get('name');

        $user->save();
        return redirect()->back()->with('success', 'Name Updated Successfully.');
    }
    public function updateProfileUsername(Request $request)
    {
        $this->validate($request, [
            'username' => ['required', 'string', 'unique:users'],
        ]);
        $user           = Auth::user();
        $user->username = $request->get('username');

        $user->save();
        return redirect()->back()->with('success', 'Username Updated Successfully.');
    }
    public function updateProfilePhone(Request $request)
    {
        $this->validate($request, [
            'phone' => ['required', 'numeric'],
        ]);
        $user        = Auth::user();
        $user->phone = $request->get('phone');

        $user->save();
        return redirect()->back()->with('success', 'Phone Number Updated Successfully.');
    }
}
