<?php

namespace LaraZeus\FilamentPluginTools\Concerns;

use Illuminate\Database\Eloquent\Model;

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

    public static function getModel(string $model): null | string | Model
    {
        return array_merge(
            config(static::get()->getId() . '.models'),
            (new static)::get()->getModels()
        )[$model] ?? null;
    }
}
