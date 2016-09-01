<?php

namespace LaravelDoctrine\Extensions;

use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Gedmo\DoctrineExtensions;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\Fluent\Extensions\GedmoExtensions;
use LaravelDoctrine\Fluent\FluentDriver;

class GedmoExtensionsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->app['events']->listen('doctrine.extensions.booting', function () {
            $registry = $this->app->make('registry');

            foreach ($registry->getManagers() as $manager) {
                $chain = $manager->getConfiguration()->getMetadataDriverImpl();

                if ($this->hasAnnotationReader($chain)) {
                    $this->registerGedmoForAnnotations($chain);
                }

                if ($this->hasFluentDriver($chain)) {
                    $this->registerGedmoForFluent($chain);
                }
            }
        });
    }

    /**
     * @param  MappingDriverChain $driver
     * @return bool
     */
    private function hasAnnotationReader(MappingDriverChain $driver)
    {
        foreach ($driver->getDrivers() as $driver) {
            if ($driver instanceof AnnotationDriver) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param  MappingDriverChain $driver
     * @return bool
     */
    private function hasFluentDriver(MappingDriverChain $driver)
    {
        foreach ($driver->getDrivers() as $driver) {
            if ($driver instanceof FluentDriver) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $chain
     */
    private function registerGedmoForAnnotations(MappingDriverChain $chain)
    {
        if ($this->needsAllMappings()) {
            DoctrineExtensions::registerMappingIntoDriverChainORM(
                $chain,
                $chain->getReader()
            );
        } else {
            DoctrineExtensions::registerAbstractMappingIntoDriverChainORM(
                $chain,
                $chain->getReader()
            );
        }
    }

    /**
     * @param MappingDriverChain $chain
     */
    private function registerGedmoForFluent(MappingDriverChain $chain)
    {
        if ($this->needsAllMappings()) {
            GedmoExtensions::registerAll($chain);
        } else {
            GedmoExtensions::registerAbstract($chain);
        }
    }

    /**
     * @return mixed
     */
    private function needsAllMappings()
    {
        return $this->app->make('config')->get('doctrine.gedmo.all_mappings', false) === true;
    }
}
