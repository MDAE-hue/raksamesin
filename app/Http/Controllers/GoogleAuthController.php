<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        if (! $this->googleLoginConfigured()) {
            return redirect()
                ->route('login')
                ->with('status', 'Login Google belum dikonfigurasi. Silakan gunakan email/password dulu.');
        }

        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        if (! $this->googleLoginConfigured()) {
            return redirect()
                ->route('login')
                ->with('status', 'Login Google belum dikonfigurasi. Silakan isi GOOGLE_CLIENT_ID dan GOOGLE_CLIENT_SECRET.');
        }

        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName() ?: $googleUser->getNickname() ?: 'Raksamesin Buyer',
                'google_id' => $googleUser->getId(),
                'avatar_url' => $googleUser->getAvatar(),
                'email_verified_at' => now(),
                'password' => Str::password(32),
            ],
        );

        if (! $user->hasAnyRole(['buyer', 'seller', 'super_admin', 'admin', 'sales', 'finance'])) {
            Role::findOrCreate('buyer');
            $user->assignRole('buyer');
        }

        Auth::login($user, remember: true);

        return redirect()->intended(route('vehicles.index'));
    }

    private function googleLoginConfigured(): bool
    {
        return filled(config('services.google.client_id'))
            && filled(config('services.google.client_secret'));
    }
}
