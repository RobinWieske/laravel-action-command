<?php

namespace RobinWieske\LaravelActionCommand;

use RobinWieske\LaravelActionCommand\Console\LaravelActionCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelActionCommandServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-action-command')
            ->hasConsoleCommand(LaravelActionCommand::class);
    }
}
