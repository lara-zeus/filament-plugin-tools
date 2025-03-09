<?php

namespace LaraZeus\FilamentPluginTools\Concerns;

trait CanDisableResources
{
    protected array $disabledResources = [];

    public function disableResources(array $resources): static
    {
        $this->disabledResources = $resources;

        return $this;
    }

    public function isResourceDisabled(string $resource): bool
    {
        return in_array($resource, $this->disabledResources, true);
    }
}
