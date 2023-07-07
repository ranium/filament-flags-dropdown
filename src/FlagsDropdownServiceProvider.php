<?php

namespace Ranium\FlagsDropdown;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FlagsDropdownServiceProvider extends PluginServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-flags-dropdown')
            ->hasConfigFile()
            ->hasViews();
    }

    protected function getStyles(): array
    {
        return [
            'filament_flags_dropdown' => __DIR__.'/../resources/dist/css/filament-flags-dropdown.css',
            'flag_icons_css_source' => config('filament-flags-dropdown.flag_icons_css', 'https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css'),
        ];
    }
}
