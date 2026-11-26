---
name: zeus-filament-plugin-tools
description: Build configurable Filament v5 plugins using Lara Zeus Filament Plugin Tools base class and configuration traits.
---

# Lara Zeus Filament Plugin Tools

## Overview & Requirements
`lara-zeus/filament-plugin-tools` provides `FilamentPluginTools` and reusable `Concerns` traits so Filament plugin authors can expose per-panel and config-backed customization options.

- **Package**: `lara-zeus/filament-plugin-tools` (Free / MIT)
- **Requirements**: PHP `^8.2`, `filament/filament` `^5.0`

## Installation
```bash
composer require lara-zeus/filament-plugin-tools
```

## Configuration & Migrations
None. `FilamentPluginToolsServiceProvider` only registers the package name (`filament-plugin-tools`). There are no config files, views, or migrations to publish.

## Plugin Class Setup
Extend `LaraZeus\FilamentPluginTools\FilamentPluginTools`, implement `Filament\Contracts\Plugin`, and use `Filament\Support\Concerns\EvaluatesClosures` alongside the desired traits:

```php
use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use LaraZeus\FilamentPluginTools\Concerns\HasNavigationGroupLabel;
use LaraZeus\FilamentPluginTools\Concerns\HasResources;
use LaraZeus\FilamentPluginTools\FilamentPluginTools;
use UnitEnum;

class MyPlugin extends FilamentPluginTools implements Plugin
{
    use EvaluatesClosures;
    use HasNavigationGroupLabel;
    use HasResources;

    protected string $pluginId = 'my-plugin';

    protected string | UnitEnum | null | Closure $navigationGroupLabel = 'My Group';

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            $this->resolveResource('PostResource'),
        ]);
    }
}
```

## Available Traits (`LaraZeus\FilamentPluginTools\Concerns\`)
- **`HasResources`**: `resources(array $resources)`, `getResources()`, `resolveResource(string $resource)`, `static getResource(string $resource)` — merges `config($id . '.resources')` with panel overrides.
- **`HasModels` / `HasEnums`**: `models(array)` / `enums(array)` and `static getModel(string)` / `static getEnum(string)` — merge `config($id . '.models')` or `config($id . '.enums')` with panel overrides.
- **`HasNavigationGroupLabel`**: `navigationGroupLabel(string|UnitEnum|Closure|null $label)`, `getNavigationGroupLabel()`.
- **`HasNavigationBadges` / `CanDisableBadges`**: `showNavigationBadges(Closure|bool $show = true, ?string $resource = null)`, `hideNavigationBadges(...)`, `getShowNavigationBadges(?string $resource = null)`, `static getNavigationBadgesVisibility(?string $resource = null)`.
- **`CanHideResources`**: `hideResources(array $resources)`, `getHiddenResources()`, `static isResourceVisible(string $resource)`.
- **`CanDisableResources`**: `disableResources(array $resources)`, `isResourceDisabled(string $resource)`.
- **`CanGloballySearch`**: `globallySearchableAttributes(array)`, `disableGlobalSearch(array)`, `getGlobalAttributes(string $class)`.
- **`CanStickyActions`**: `formActionsAreSticky(bool $condition = false)`, `isFormActionsAreSticky()`.
- **`HasRouteNamePrefix`**: `routePrefix(Closure|string|null $prefix)`, `getRouteNamePrefix()`.
- **`HasUploads`**: `uploadDisk(Closure|string $disk)`, `getUploadDisk()`, `uploadDirectory(Closure|string $dir)`, `getUploadDirectory()`.

## Common Pitfalls & Anti-Patterns
- **Missing `$pluginId`**: `FilamentPluginTools::getId()` returns `$this->pluginId`; omitting it causes an undefined property error.
- **Missing `EvaluatesClosures`**: `FilamentPluginTools` does not use `EvaluatesClosures` itself; traits calling `$this->evaluate(...)` will fail unless your plugin class uses `Filament\Support\Concerns\EvaluatesClosures`.
- **Null config keys with `HasModels` / `HasEnums`**: `HasModels::getModel()` and `HasEnums::getEnum()` pass `config(static::get()->getId() . '.models')` (or `.enums`) directly to `array_merge()`; ensure those config keys return arrays.
- **`getResource()` during `register()`**: Always use `$this->resolveResource('...')` inside `Plugin::register()`, and `MyPlugin::getResource('...')` at runtime.
