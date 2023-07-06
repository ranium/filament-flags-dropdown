<?php

namespace Ranium\FlagsDropdown;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Ranium\FlagsDropdown\Commands\FlagsDropdownCommand;

class FlagsDropdownServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-flags-dropdown')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament-flags-dropdown_table')
            ->hasCommand(FlagsDropdownCommand::class);
    }
}
