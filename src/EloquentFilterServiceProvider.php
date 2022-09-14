<?php

namespace SyahrinSeth\EloquentFilter;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use SyahrinSeth\EloquentFilter\Commands\EloquentFilterCommand;

class EloquentFilterServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('eloquent-filter')
            ->hasConfigFile()
            // ->hasViews()
            // ->hasMigration('create_eloquent-filter_table')
            ->hasCommand(EloquentFilterCommand::class);
    }
}
