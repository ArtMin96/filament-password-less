<?php

namespace ArtMin96\FilamentPasswordLess\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PassPhraseSent
{
    use Dispatchable;
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
