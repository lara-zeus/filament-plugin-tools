---
title: Has Resources
weight: 2
---

## Config File

first, provide an array in your config file, contain the resource name as a key, and its value will be the full path:
For example, let say you plugin needs two resources, a UserResource and a BookmarkResource:

```php
/**
 * you can overwrite any resource and use your own
 * you can also configure the resource per panel in your panel provider
 * using: ->resources([ ... ])
 */
'resources' => [
    'UserResource' => \LaraZeus\Delia\Filament\Resources\UserResource::class,
    'BookmarkResource' => \LaraZeus\Delia\Filament\Resources\BookmarkResource::class,
],
```

This way, your users can configure the resources per panel or globally from the config file:

```php
public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugins([
            MyAwesomePlugin::make()
                ->resources([
                    'UserResource' => \App\Filament\Resources\CustomUserResource::class,
                ]),
        ]);
}
```

with this approach, `FilamentPluginTools` will merge the resources from the config file, and what the user provide per panel.

now, in your plugin, you can use it at runtime like:

```php
MyAwesomePlugin::getResource('UserResource')
```

Inside `Plugin::register(Panel $panel)`, before Filament's default panel is registered, use the instance method `resolveResource()` instead:

```php
public function register(Panel $panel): void
{
    $panel->resources([
        $this->resolveResource('UserResource'),
    ]);
}
```
