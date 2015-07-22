<?php

namespace LaravelDoctrine\ORM;

use Gedmo\DoctrineExtensions;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\Extensions\DriverChain;

/**
 * Class GedmoExtensionsServiceProvider
 * @package LaravelDoctrine\ORM
 */
class GedmoExtensionsServiceProvider extends ServiceProvider
{

    /**
     * Register the chain and reader with Gedmo
     */
    public function boot()
    {
        $driverChain = $this->app[DriverChain::class];

        DoctrineExtensions::registerMappingIntoDriverChainORM(
            $driverChain->getChain(),
            $driverChain->getReader()
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
        // Nothing to register, makes me think a service provider may not be the best solution.
    }
}