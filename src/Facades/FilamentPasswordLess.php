<?php

namespace ArtMin96\FilamentPasswordLess\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ArtMin96\FilamentPasswordLess\FilamentPasswordLess
 */
class FilamentPasswordLess extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'filament-password-less';
    }
}
