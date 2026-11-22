<?php

namespace LaraZeus\FilamentPluginTools\Concerns;

trait HasResources
{
    protected array $resources = [];

    public function resources(array $resources): static
    {
        $this->resources = $resources;

        return $this;
    }

    public function getResources(): array
    {
        return $this->resources;
    }

    public function resolveResource(string $resource): ?string
    {
        return array_merge(
            (array) (config($this->getId() . '.resources', []) ?? []),
            $this->getResources()
        )[$resource] ?? null;
    }

    public static function getResource(string $resource): ?string
    {
        return static::get()->resolveResource($resource);
    }
}
