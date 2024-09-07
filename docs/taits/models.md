---
title: Has Models
weight: 1
---

## Config File

first, provide an array in your config file, contain the model class name as a keey, and its value will be the full path:
For example, let say you plugin needs two models, the user model and a Bookmark model:

```php
/**
 * you can overwrite any model and use your own
 * you can also configure the model per panel in your panel provider
 * using: ->models([ ... ])
 */
'models' => [
    'User' => config('auth.providers.users.model'),
    'Bookmark' => \LaraZeus\Delia\Models\Bookmark::class,
],
```

This way, your users can configure the models per panel or globally from the config file:

```php
public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugins([
            MyAwesomePlugin::make()
                ->models([
                    'User' => \App\Models\Manager::class
                ]),
        ]);
}
```

with this approach, `FilamentPluginTools` will merge the models from the config file, and what the user provide per panel.

now, in your plugin, you can use it like:

```php
MyAwesomePlugin::getModel('User')
```