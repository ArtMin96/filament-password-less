<?php

namespace ArtMin96\FilamentPasswordLess;

use ArtMin96\FilamentPasswordLess\Events\PassPhraseSent;
use ArtMin96\FilamentPasswordLess\Listeners\RequirePassPhrase;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PassPhraseSent::class => [
            RequirePassPhrase::class,
        ],
    ];
}
