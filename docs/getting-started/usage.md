---
title: Usage
weight: 3
---

## Add a trait

Simple all you need is to add the needed trait to your plugin,
for example if you eant your users to ccustomize the navigation group label, add the trait to you plugin.

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

For more, check the available traits and how to use each one of them.
