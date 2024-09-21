<?php

namespace Joukhar\LaravelPixabay;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Joukhar\LaravelPixabay\Commands\LaravelPixabayCommand;

class LaravelPixabayServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-pixabay')
            ->hasConfigFile();
    }
}
