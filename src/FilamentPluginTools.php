<?php

namespace LaraZeus\FilamentPluginTools;

use Filament\Panel;

class FilamentPluginTools
{
    public function getId(): string
    {
        // @phpstan-ignore-next-line
        return $this->pluginId;
    }

    public static function get(): static
    {
        // @phpstan-ignore-next-line
        return filament(static::make()->getId());
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
