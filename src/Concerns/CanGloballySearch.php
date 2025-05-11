<?php

namespace LaraZeus\FilamentPluginTools\Concerns;

trait CanGloballySearch
{
    public array $globallySearchableAttributes = [];

    public bool $disableGlobalSearch = false;

    public function globallySearchableAttributes(array $label): static
    {
        $this->globallySearchableAttributes = $label;

        return $this;
    }

    public function getGloballySearchableAttributes(): array
    {
        return $this->globallySearchableAttributes;
    }

    public function disableGlobalSearch(bool $condetion): static
    {
        $this->disableGlobalSearch = $condetion;

        return $this;
    }

    public function isGlobaSearchDisabled(): bool
    {
        return $this->disableGlobalSearch;
    }

    public function getGlobalAttributes(string $class): array
    {
        if ($this->isGlobaSearchDisabled()) {
            return [];
        }

        return optional(array_merge(
            (new static)::get()->defaultGloballySearchableAttributes,
            $this->globallySearchableAttributes
        ))[$class] ?? [$class];
    }
}
