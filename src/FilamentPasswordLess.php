<?php

namespace ArtMin96\FilamentPasswordLess;

use Illuminate\Support\Facades\Session;

class FilamentPasswordLess
{
    public function passPhraseExpiry(): int
    {
        return config('filament-password-less.passphrase_expiry');
    }

    public function usesMagicLink(): bool
    {
        return config('filament-password-less.using_magic_link');
    }

    public function getUser(null|string $email = null)
    {
        $email = $email ?: (Session::has('email') ? Session::get('email') : null);

        if (! $email) {
            return null;
        }

        $userModel = config('filament-password-less.user_model');

        return $userModel::where('email', $email)->first();
    }

    public function getUserById(int $id)
    {
        if (! $id) {
            return null;
        }

        $userModel = config('filament-password-less.user_model');

        return $userModel::find($id);
    }
}
