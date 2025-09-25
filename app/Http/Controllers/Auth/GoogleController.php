<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            \Log::info('Google User Data:', [
                'id' => $googleUser->getId(),
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
            ]);

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(uniqid()),
                ]
            );

            \Log::info('User created/found:', [
                'user_id' => $user->id,
                'email' => $user->email,
                'google_id' => $user->google_id,
            ]);

            Auth::login($user);

            \Log::info('Auth check after login:', [
                'is_authenticated' => Auth::check(),
                'user_id' => Auth::id(),
            ]);

            return redirect()->intended('/pt/dashboard');
        } catch (\Exception $e) {
            \Log::error('Google Auth Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect('/login')->withErrors(['msg' => 'Erro ao autenticar com Google: ' . $e->getMessage()]);
        }
    }
}
