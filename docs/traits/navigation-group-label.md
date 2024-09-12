---
title: Has Navigation Group Label
weight: 2
---

## Navigation Group Label

This allow your users to customize the navigation label resources
first add the trait to your plugin:

```php
class MyAwesomePlugin extends FilamentPluginTools implements Plugin
{
    use HasNavigationGroupLabel;
}
```

then set the default navigation group label:

```php
protected string $navigationGroupLabel = 'Awesome';
```

and in your resource:

```php
public static function getNavigationGroup(): ?string
{
    return MyAwesomePlugin::get()->getNavigationGroupLabel();
}
```


Now, if your users want to set the navigation group label:

```php
public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugins([
            MyAwesomePlugin::make()
                ->navigationGroupLabel('New Awesome'),
        ]);
}
```
