<?php

namespace LaraZeus\FilamentPluginTools\Concerns;

trait CanGloballySearch
{
    public array $globallySearchableAttributes = [];

    public function globallySearchableAttributes(array $label): static
    {
        $this->globallySearchableAttributes = $label;

        return $this;
    }

    public function getGloballySearchableAttributes(): array
    {
        return $this->globallySearchableAttributes;
    }

    public function getGlobalAttributes(string $class): array
    {
        return optional(array_merge(
            (new static)::get()->defaultGloballySearchableAttributes,
            $this->globallySearchableAttributes
        ))[$class] ?? [$class];
    }
}
