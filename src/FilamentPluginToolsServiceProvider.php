<?php

namespace LaraZeus\FilamentPluginTools;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentPluginToolsServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-plugin-tools';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name);
    }
}
