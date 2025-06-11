---
title: Has Enums
weight: 2
---

## Config File

first, provide an array in your config file, contain the enum names as a key, and its value will be the full path:
For example, let say you plugin needs two enums, the user type enum and a status enums:

```php
/**
 * you can overwrite any enum and use your own
 * you can also configure the enum per panel in your panel provider
 * using: ->enums([ ... ])
 */
'enums' => [
    'UserType' => \LaraZeus\Package\Enums\UserType::class,
    'Status' => \LaraZeus\Delia\Package\Status::class,
],
```

This way, your users can configure the enums per panel or globally from the config file:

```php
public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugins([
            MyAwesomePlugin::make()
                ->enums([
                    'UserType' => \LaraZeus\Package\Enums\UserType::class
                    //...
                ]),
        ]);
}
```

with this approach, `FilamentPluginTools` will merge the enums from the config file, and what the user provide per panel.

now, in your plugin, you can use it like:

```php
MyAwesomePlugin::getEnum('UserType')
```