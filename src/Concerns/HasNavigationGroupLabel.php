<?php

namespace LaraZeus\FilamentPluginTools\Concerns;

use Closure;
use UnitEnum;

trait HasNavigationGroupLabel
{
    public function navigationGroupLabel(string | UnitEnum | null | Closure $label): static
    {
        $this->navigationGroupLabel = $label;

        return $this;
    }

    public function getNavigationGroupLabel(): string | UnitEnum | null
    {
        return $this->evaluate($this->navigationGroupLabel);
    }
}
