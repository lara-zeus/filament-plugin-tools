<?php

namespace LaraZeus\FilamentPluginTools\Concerns;

trait CanHideResources
{
    protected array $hideResources = [];

    public function hideResources(array $resources): static
    {
        $this->hideResources = $resources;

        return $this;
    }

    public function getHiddenResources(): ?array
    {
        return $this->hideResources;
    }

    public static function isResourceVisible(string $resource): bool
    {
        return ! in_array($resource, (new static)::get()->getHiddenResources());
    }
}
