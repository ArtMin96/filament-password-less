<?php

namespace ArtMin96\FilamentPasswordLess\Tests;

use ArtMin96\FilamentPasswordLess\FilamentPasswordLessServiceProvider;
use Filament\FilamentServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            FilamentServiceProvider::class,
            FilamentPasswordLessServiceProvider::class,
        ];
    }
}
