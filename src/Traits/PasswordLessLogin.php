<?php

namespace ArtMin96\FilamentPasswordLess\Traits;

use ArtMin96\FilamentPasswordLess\Notifications\AdvisePassPhrase;
use ArtMin96\FilamentPasswordLess\Notifications\AdvisePassPhraseMagicLink;

trait PasswordLessLogin
{
    public function advisePassPhrase(string $passphrase)
    {
        return $this->notify(new AdvisePassPhrase($passphrase));
    }

    public function advisePassPhraseMagicLink(string $passphrase)
    {
        return $this->notify(new AdvisePassPhraseMagicLink($passphrase));
    }
}
