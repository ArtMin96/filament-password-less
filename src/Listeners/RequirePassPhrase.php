<?php

namespace ArtMin96\FilamentPasswordLess\Listeners;

use ArtMin96\FilamentPasswordLess\FilamentPasswordLess;
use ArtMin96\FilamentPasswordLess\Utility\PassPhrase;
use Illuminate\Support\Facades\Session;

class RequirePassPhrase
{
    protected PassPhrase $generator;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PassPhrase $generator)
    {
        $this->generator = $generator;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event): void
    {
        $passphrase = $this->generator->passPhrase(config('filament-password-less.passphrase_count'));

        Session::put('passphrase', $passphrase);
        Session::put(
            'passphrase_expiry',
            now()->addMinutes(
                app(FilamentPasswordLess::class)->passPhraseExpiry()
            )->timestamp
        );

        if (app(FilamentPasswordLess::class)->usesMagicLink()) {
            $event->user->advisePassPhraseMagicLink($passphrase);
        } else {
            $event->user->advisePassPhrase($passphrase);
        }
    }
}
