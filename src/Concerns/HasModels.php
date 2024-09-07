<?php

namespace LaraZeus\FilamentPluginTools\Concerns;

trait HasModels
{
    protected array $models = [];

    public function models(array $models): static
    {
        $this->models = $models;

        return $this;
    }

    public function getModels(): array
    {
        return $this->models;
    }

    public static function getModel(string $model): string
    {
        return array_merge(
            config(static::get()->getId() . '.models'),
            (new static)::get()->getModels()
        )[$model];
    }
}
