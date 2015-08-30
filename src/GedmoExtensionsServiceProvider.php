<?php

namespace LaravelDoctrine\Extensions;

use Doctrine\Common\Persistence\ManagerRegistry;
use Gedmo\DoctrineExtensions;
use Illuminate\Support\ServiceProvider;

class GedmoExtensionsServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider
     *
     * @param ManagerRegistry $registry
     */
    public function boot(ManagerRegistry $registry)
    {
        foreach ($registry->getManagers() as $manager) {
            $chain  = $manager->getConfiguration()->getMetadataDriverImpl();
            $reader = $chain->getReader();

            if ($this->app->make('config')->get('doctrine.gedmo.all_mappings', false)) {
                DoctrineExtensions::registerMappingIntoDriverChainORM(
                    $chain,
                    $reader
                );
            } else {
                DoctrineExtensions::registerAbstractMappingIntoDriverChainORM(
                    $chain,
                    $reader
                );
            }
        }
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
    }
}
