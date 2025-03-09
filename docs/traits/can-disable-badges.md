---
title: Disable Badges
weight: 2
---

## Disable Badges

This allow your users to customize the badges of the resource
first add the trait to your plugin:

```php
class MyAwesomePlugin extends FilamentPluginTools implements Plugin
{
    use CanDisableBadges;
}
```

and in your resource:

```php
public static function getNavigationBadge(): ?string
{
    if(MyAwesomePlugin::get()->getNavigationBadgesVisibility(static::class)){
        return '10 new items';
    }
}
```
Now, if your users want to disable the badge:

```php
public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugins([
            MyAwesomePlugin::make()
                ->hideNavigationBadges(MyResource::class),
        ]);
}
```
