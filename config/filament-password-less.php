<?php

return [
    /**
     * Magic link
     *
     * Maybe you want to log in with a temporary generated link.
     * If yes, set it to true.
     */
    'using_magic_link' => false,

    /**
     * Rate limit count
     */
    'rate_limit_count' => 5,

    /**
     * Passphrase count
     *
     * Passphrase is a combination of 3 or 4 words separated by hyphens.
     */
    'passphrase_count' => 3,

    /**
     * Passphrase expiry (minutes)
     */
    'passphrase_expiry' => 15,

    /**
     * User model
     */
    'user_model' => \App\Models\User::class,

    /**
     * Login confirmation page component
     *
     * If you want to change something, place your component here.
     */
    'confirm_passphrase_component' => \ArtMin96\FilamentPasswordLess\Http\Livewire\Auth\Confirm::class,
];
