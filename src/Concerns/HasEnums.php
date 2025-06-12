<?php

namespace LaraZeus\FilamentPluginTools\Concerns;

trait HasEnums
{
    protected array $enums = [];

    public function enums(array $enums): static
    {
        $this->enums = $enums;

        return $this;
    }

    public function getEnums(): array
    {
        return $this->enums;
    }

    public static function getEnum(string $enum): ?string
    {
        return array_merge(
            config(static::get()->getId() . '.enums'),
            (new static)::get()->getEnums()
        )[$enum] ?? null;
    }
}
