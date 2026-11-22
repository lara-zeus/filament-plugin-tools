<?php

namespace LaraZeus\FilamentPluginTools\Tests\Fixtures;

use LaraZeus\FilamentPluginTools\Concerns\HasResources;
use LaraZeus\FilamentPluginTools\FilamentPluginTools;

class ResourcesPlugin extends FilamentPluginTools
{
    use HasResources;

    protected string $pluginId = 'test-resources-plugin';

    public static function get(): static
    {
        return app(static::class);
    }
}
