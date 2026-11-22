<?php

namespace LaraZeus\FilamentPluginTools\Tests\Fixtures;

use Closure;
use Filament\Support\Concerns\EvaluatesClosures;
use LaraZeus\FilamentPluginTools\Concerns\HasNavigationGroupLabel;
use LaraZeus\FilamentPluginTools\FilamentPluginTools;
use UnitEnum;

class NavigationGroupPlugin extends FilamentPluginTools
{
    use EvaluatesClosures;
    use HasNavigationGroupLabel;

    protected string | UnitEnum | null | Closure $navigationGroupLabel = null;
}
