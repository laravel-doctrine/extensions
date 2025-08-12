<?php

declare(strict_types=1);

namespace LaravelDoctrine\Extensions;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;
use Gedmo\DoctrineExtensions;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\Fluent\Extensions\GedmoExtensions;
use LaravelDoctrine\Fluent\FluentDriver;

use function method_exists;

class GedmoExtensionsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app['events']->listen('doctrine.extensions.booting', function (): void {
            $registry = $this->app->make('registry');

            foreach ($registry->getManagers() as $manager) {
                $chain = $manager->getConfiguration()->getMetadataDriverImpl();

                if ($this->hasAnnotationReader($chain)) {
                    $this->registerGedmoForAnnotations($chain);
                }

                if (! $this->hasFluentDriver($chain)) {
                    continue;
                }

                $this->registerGedmoForFluent($chain);
            }
        });
    }

    private function hasAnnotationReader(MappingDriverChain $driver): bool
    {
        foreach ($driver->getDrivers() as $driver) {
            if ($driver instanceof AnnotationDriver) {
                return true;
            }
        }

        return false;
    }

    private function hasFluentDriver(MappingDriverChain $driver): bool
    {
        foreach ($driver->getDrivers() as $driver) {
            if ($driver instanceof FluentDriver) {
                return true;
            }
        }

        return false;
    }

    /** @throws BindingResolutionException */
    private function registerGedmoForAnnotations(MappingDriverChain $chain): void
    {
        if ($this->needsAllMappings()) {
            DoctrineExtensions::registerMappingIntoDriverChainORM($chain);
        } else {
            DoctrineExtensions::registerAbstractMappingIntoDriverChainORM($chain);
        }

        if (! method_exists(AnnotationRegistry::class, 'registerUniqueLoader')) {
            return;
        }

        AnnotationRegistry::registerUniqueLoader('class_exists');
    }

    /** @throws BindingResolutionException */
    private function registerGedmoForFluent(MappingDriverChain $chain): void
    {
        if ($this->needsAllMappings()) {
            GedmoExtensions::registerAll($chain);
        } else {
            GedmoExtensions::registerAbstract($chain);
        }
    }

    /** @throws BindingResolutionException */
    private function needsAllMappings(): bool
    {
        return $this->app->make('config')->get('doctrine.gedmo.all_mappings', false) === true;
    }
}
