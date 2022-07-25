<?php

namespace ArtMin96\FilamentPasswordLess;

use ArtMin96\FilamentPasswordLess\Http\Livewire\Auth\Confirm;
use ArtMin96\FilamentPasswordLess\Http\Livewire\Auth\Login;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentPasswordLessServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-password-less')
            ->hasConfigFile()
            ->hasTranslations()
            ->hasViews()
            ->hasRoute('web');
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function bootingPackage()
    {
        parent::packageBooted();

        Livewire::component(Login::getName(), Login::class);
        Livewire::component(Confirm::getName(), Confirm::class);
    }

    /**
     * @throws \Spatie\LaravelPackageTools\Exceptions\InvalidPackage
     */
    public function register()
    {
        parent::register();

        $this->app->register(EventServiceProvider::class);
    }
}
