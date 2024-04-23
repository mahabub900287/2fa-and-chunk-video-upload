<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function twoFactorEnable(Request $request)
    {
        //check if post method
        $admin = auth()->user();
        $google2fa = app('pragmarx.google2fa');
        $google2fa_secret = $google2fa->generateSecretKey();
        $admin->google2fa_secret = $google2fa_secret;
        $admin->save();

        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $admin->email,
            $admin->google2fa_secret
        );

        return view('google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $admin->google2fa_secret]);
    }
    public function twoFactorDisable(Request $request)
    {
        $admin = auth()->user();
        $admin->google2fa_secret = null;
        $admin->save();

        return redirect(route('home'));
    }
}
