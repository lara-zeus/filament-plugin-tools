<?php

use LaraZeus\FilamentPluginTools\Tests\Fixtures\BackedNavigationGroupEnum;
use LaraZeus\FilamentPluginTools\Tests\Fixtures\NavigationGroupEnum;
use LaraZeus\FilamentPluginTools\Tests\Fixtures\NavigationGroupPlugin;
use LaraZeus\FilamentPluginTools\Tests\Fixtures\NavigationGroupPluginWithDefault;

beforeEach(function () {
    $this->plugin = new NavigationGroupPlugin;
});

it('returns null by default when navigation group label is initialized to null', function () {
    expect($this->plugin->getNavigationGroupLabel())->toBeNull();
});

it('returns the default string label when configured on the plugin', function () {
    $plugin = new NavigationGroupPluginWithDefault;

    expect($plugin->getNavigationGroupLabel())->toBe('Default Group');
});

it('returns the plugin instance for fluent chaining', function () {
    expect($this->plugin->navigationGroupLabel('Awesome'))->toBe($this->plugin);
});

it('can set and get a string navigation group label', function () {
    $this->plugin->navigationGroupLabel('Custom Group');

    expect($this->plugin->getNavigationGroupLabel())->toBe('Custom Group');
});

it('can set and get a UnitEnum navigation group label', function () {
    $this->plugin->navigationGroupLabel(NavigationGroupEnum::Settings);

    expect($this->plugin->getNavigationGroupLabel())->toBe(NavigationGroupEnum::Settings);
});

it('can set and get a BackedEnum navigation group label', function () {
    $this->plugin->navigationGroupLabel(BackedNavigationGroupEnum::Content);

    expect($this->plugin->getNavigationGroupLabel())->toBe(BackedNavigationGroupEnum::Content);
});

it('can set the navigation group label to null', function () {
    $plugin = new NavigationGroupPluginWithDefault;
    $plugin->navigationGroupLabel(null);

    expect($plugin->getNavigationGroupLabel())->toBeNull();
});

it('can evaluate a closure returning a string', function () {
    $this->plugin->navigationGroupLabel(fn (): string => 'Dynamic Group');

    expect($this->plugin->getNavigationGroupLabel())->toBe('Dynamic Group');
});

it('can evaluate a closure returning a UnitEnum', function () {
    $this->plugin->navigationGroupLabel(fn (): UnitEnum => NavigationGroupEnum::Content);

    expect($this->plugin->getNavigationGroupLabel())->toBe(NavigationGroupEnum::Content);
});

it('can evaluate a closure returning a BackedEnum', function () {
    $this->plugin->navigationGroupLabel(fn (): UnitEnum => BackedNavigationGroupEnum::Settings);

    expect($this->plugin->getNavigationGroupLabel())->toBe(BackedNavigationGroupEnum::Settings);
});

it('can evaluate a closure returning null', function () {
    $this->plugin->navigationGroupLabel(fn (): ?string => null);

    expect($this->plugin->getNavigationGroupLabel())->toBeNull();
});

it('evaluates closures lazily when getting the navigation group label', function () {
    $label = 'Initial';

    $this->plugin->navigationGroupLabel(function () use (&$label): string {
        return $label;
    });

    $label = 'Updated';

    expect($this->plugin->getNavigationGroupLabel())->toBe('Updated');
});
