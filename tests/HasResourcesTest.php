<?php

use LaraZeus\FilamentPluginTools\Tests\Fixtures\ResourcesPlugin;

beforeEach(function () {
    $this->plugin = new ResourcesPlugin;
    app()->instance(ResourcesPlugin::class, $this->plugin);

    config()->set('test-resources-plugin', null);
});

it('returns an empty array by default from getResources', function () {
    expect($this->plugin->getResources())->toBe([]);
});

it('returns the plugin instance for fluent chaining and stores resources', function () {
    $resources = [
        'UserResource' => 'App\\Filament\\Resources\\UserResource',
    ];

    expect($this->plugin->resources($resources))->toBe($this->plugin)
        ->and($this->plugin->getResources())->toBe($resources);
});

it('reads a resource from config when not overridden on the plugin', function () {
    config()->set('test-resources-plugin.resources', [
        'UserResource' => 'App\\Filament\\Resources\\ConfigUserResource',
        'PostResource' => 'App\\Filament\\Resources\\ConfigPostResource',
    ]);

    expect(ResourcesPlugin::getResource('UserResource'))->toBe('App\\Filament\\Resources\\ConfigUserResource')
        ->and(ResourcesPlugin::getResource('PostResource'))->toBe('App\\Filament\\Resources\\ConfigPostResource');
});

it('prefers plugin resources over config resources', function () {
    config()->set('test-resources-plugin.resources', [
        'UserResource' => 'App\\Filament\\Resources\\ConfigUserResource',
        'PostResource' => 'App\\Filament\\Resources\\ConfigPostResource',
    ]);

    $this->plugin->resources([
        'UserResource' => 'App\\Filament\\Resources\\PluginUserResource',
    ]);

    expect(ResourcesPlugin::getResource('UserResource'))->toBe('App\\Filament\\Resources\\PluginUserResource')
        ->and(ResourcesPlugin::getResource('PostResource'))->toBe('App\\Filament\\Resources\\ConfigPostResource');
});

it('returns null when the resource key is missing or config is not set', function () {
    expect(ResourcesPlugin::getResource('MissingResource'))->toBeNull();

    config()->set('test-resources-plugin.resources', [
        'UserResource' => 'App\\Filament\\Resources\\ConfigUserResource',
    ]);

    expect(ResourcesPlugin::getResource('MissingResource'))->toBeNull();
});

it('resolves resources on an instance without needing a registered Filament panel', function () {
    $plugin = new ResourcesPlugin;

    config()->set('test-resources-plugin.resources', [
        'UserResource' => 'App\\Filament\\Resources\\ConfigUserResource',
        'PostResource' => 'App\\Filament\\Resources\\ConfigPostResource',
    ]);

    $plugin->resources([
        'UserResource' => 'App\\Filament\\Resources\\PluginUserResource',
    ]);

    expect($plugin->resolveResource('UserResource'))->toBe('App\\Filament\\Resources\\PluginUserResource')
        ->and($plugin->resolveResource('PostResource'))->toBe('App\\Filament\\Resources\\ConfigPostResource')
        ->and($plugin->resolveResource('MissingResource'))->toBeNull();
});
