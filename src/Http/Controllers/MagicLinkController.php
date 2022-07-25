<?php

namespace ArtMin96\FilamentPasswordLess\Http\Controllers;

use ArtMin96\FilamentPasswordLess\FilamentPasswordLess;
use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MagicLinkController extends Controller
{
    public function __invoke(Request $request, $userId)
    {
        $user = app(FilamentPasswordLess::class)->getUserById($userId);

        if (
            ! $request->hasValidSignature() ||
            $request->code != $request->session()->get('passphrase') ||
            ! $user
        ) {
            abort(401);
        }

        $request->session()->forget('passphrase');
        $request->session()->forget('passphrase_expiry');

        Filament::auth()->login($user);

        return app(LoginResponse::class);
    }
}
