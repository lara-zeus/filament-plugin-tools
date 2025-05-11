<?php

namespace LaraZeus\FilamentPluginTools\Concerns;

trait CanGloballySearch
{
    public array $globallySearchableAttributes = [];

    public array $disableGlobalSearch = [];

    public function globallySearchableAttributes(array $label): static
    {
        $this->globallySearchableAttributes = $label;

        return $this;
    }

    public function getGloballySearchableAttributes(): array
    {
        return $this->globallySearchableAttributes;
    }

    public function disableGlobalSearch(array $resources): static
    {
        $this->disableGlobalSearch = $resources;

        return $this;
    }

    public function getDisabledGlobalSearch(): array
    {
        return $this->disableGlobalSearch;
    }

    public function getGlobalAttributes(string $class): array
    {
        if (in_array($class, $this->getDisabledGlobalSearch(), true)) {
            return [];
        }

        return optional(array_merge(
            (new static)::get()->defaultGloballySearchableAttributes,
            $this->globallySearchableAttributes
        ))[$class] ?? [$class];
    }
}
