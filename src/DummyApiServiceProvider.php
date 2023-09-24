<?php

namespace EminCimen\DummyApi;

use EminCimen\DummyApi\Commands\DummyApiCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DummyApiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('dummyapi')
            ->hasConfigFile()
            ->hasCommand(DummyApiCommand::class);
    }
}
