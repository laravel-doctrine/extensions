<?php

namespace LaravelDoctrine\Extensions;

use Gedmo\DoctrineExtensions;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\Extensions\DriverChain;

class GedmoExtensionsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $driverChain = $this->app->make(DriverChain::class);

        if ($this->app['config']->get('doctrine.gedmo.all_mappings', false)) {
            DoctrineExtensions::registerMappingIntoDriverChainORM(
                $driverChain->getChain(),
                $driverChain->getReader()
            );
        } else {
            DoctrineExtensions::registerAbstractMappingIntoDriverChainORM(
                $driverChain->getChain(),
                $driverChain->getReader()
            );
        }
    }
}
