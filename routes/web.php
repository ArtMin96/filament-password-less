<?php

use ArtMin96\FilamentPasswordLess\Http\Controllers\MagicLinkController;
use ArtMin96\FilamentPasswordLess\Http\Middleware\PassPhraseGuard;
use Illuminate\Support\Facades\Route;

$middleware = array_merge(config("filament.middleware.base"), [PassPhraseGuard::class]);

Route::domain(config("filament.domain"))
    ->middleware($middleware)
    ->name('filament.auth.login.')
    ->prefix(config("filament.path"))
    ->group(function () {
        Route::get('/confirm', config('filament-password-less.confirm_passphrase_component'))->name('confirm');
        Route::get('/login/magic/{userId}', MagicLinkController::class)->name('magiclink');
    });
