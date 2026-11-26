## Lara Zeus Filament Plugin Tools (`lara-zeus/filament-plugin-tools`)

A utility library providing a base class and reusable configuration traits for building configurable Filament v5 plugins.

### Key Classes & Traits
- Base class: `LaraZeus\FilamentPluginTools\FilamentPluginTools` (provides `getId()`, `static get()`, `boot(Panel $panel)`)
- ServiceProvider: `LaraZeus\FilamentPluginTools\FilamentPluginToolsServiceProvider`
- Traits under `LaraZeus\FilamentPluginTools\Concerns\`:
  - `HasNavigationGroupLabel`, `HasNavigationBadges`, `CanDisableBadges`
  - `HasResources`, `CanHideResources`, `CanDisableResources`, `CanGloballySearch`
  - `HasModels`, `HasEnums`, `HasRouteNamePrefix`, `HasUploads`, `CanStickyActions`

### Rules & Anti-Patterns
- **Do not register as a panel plugin**: This is a developer library for plugin authors; do not call `->plugin(FilamentPluginTools::make())` on a Filament `Panel`.
- **Define `$pluginId` and `EvaluatesClosures`**: `FilamentPluginTools::getId()` reads `$this->pluginId`. Traits that call `$this->evaluate(...)` (`HasNavigationGroupLabel`, `HasNavigationBadges`, `CanDisableBadges`, `CanStickyActions`, `HasRouteNamePrefix`, `HasUploads`) require `Filament\Support\Concerns\EvaluatesClosures` on your plugin class.
- **Declare required default properties**: `HasNavigationGroupLabel` expects `$navigationGroupLabel`, and `CanGloballySearch` expects `$defaultGloballySearchableAttributes` on the plugin class.
- **Use `resolveResource()` inside `register()`**: Call `$this->resolveResource('Key')` inside `Plugin::register(Panel $panel)` instead of `static::getResource('Key')`, because `static::get()` resolves from the active Filament panel during `boot()` / runtime.
