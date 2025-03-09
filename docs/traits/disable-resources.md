---
title: Disable Resources
weight: 3
---

## Disable a Resource

if your plugin has many resources, users can disable them if they needed.

to implement this, add the trait to yor plugin:

```php
class MyAwesomePlugin extends FilamentPluginTools implements Plugin
{
    use CanDisableResources;
}
```

in your resource you can check if the given resource is hidden:

```php
public static function shouldRegisterNavigation(): bool
{
    return MyAwesomePlugin::isResourceDisabled(static::class);
}
```

Now, your users can hide any resource:

```php
public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugins([
            MyAwesomePlugin::make()
                ->hideResources([
                    AwesomeResource::class,
                ]),
        ]);
}
```
