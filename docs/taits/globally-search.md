---
title: Can Globally Search
weight: 4
---

## Global Search

you can let your user customize the Global Search for a resource

to implement this, add the trait to yor plugin:

```php
class MyAwesomePlugin extends FilamentPluginTools implements Plugin
{
    use CanGloballySearch;
}
```

and defined the default searchs:

```php
public array $defaultGloballySearchableAttributes = [
    AwesomeResource::class => ['title', 'slug'],
];
```

in your resource you can get the configuration like:

```php
public static function getGloballySearchableAttributes(): array
{
    return MyAwesomePlugin::get()->getGlobalAttributes(static::class);
}
```

Now, your users can configure the global search in the panel:

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
