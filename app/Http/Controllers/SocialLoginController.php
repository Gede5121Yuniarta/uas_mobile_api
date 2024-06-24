<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class SocialLoginController extends Controller
{
    // Login menggunakan Google
    public function googleLoginPage()
    {
        session(['google_auth_type' => 'login']);
        return Socialite::driver('google')
            ->redirect();
    }

    public function googleRegisterAdminPage()
    {
        session(['google_auth_type' => 'egister.google.admin']);
        return Socialite::driver('google')
            ->redirect();
    }

    public function googleRegisterUserPage()
    {
        session(['google_auth_type' => 'egister.google.user']);
        return Socialite::driver('google')
            ->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $type = $request->session()->get('google_auth_type');
            \Log::info('Google Auth Type: ' . $type);

            $user = User::where('google_id', $google_user->getId())->first();

            if ($type == 'login') {
                if ($user) {
                    Auth::login($user);
                    return $user->type == 'admin' ? redirect()->route('admin.dashboard') : redirect()->route('user.dashboard');
                } else {
                    return redirect()->route('login')->withErrors(['email' => 'Account not found. Please register first.']);
                }
            } else {
                if (!$user) {
                    $new_user = User::create([
                        'name' => $google_user->getName(),
                        'email' => $google_user->getEmail(),
                        'google_id' => $google_user->getId(),
                        'password' => encrypt('123456dummy'),
                        'type' => $type == 'egister.google.admin' ? 'admin' : 'user',
                    ]);

                    Auth::login($new_user);

                    // Redirect to input brand page for admin
                    if ($new_user->type == 'admin') {
                        return redirect()->route('input.brand.page');
                    } else {
                        return redirect()->route('user.dashboard');
                    }
                } else {
                    return redirect()->route('login')->withErrors(['email' => 'Account already exists. Please login.']);
                }
            }
        } catch (\Throwable $e) {
            return redirect()->route('login')->withErrors(['error' => $e->getMessage()]);
        }
    }
}