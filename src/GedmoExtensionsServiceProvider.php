<?php

namespace LaravelDoctrine\Extensions;

use Doctrine\Common\Annotations\Reader;
use Gedmo\DoctrineExtensions;
use Illuminate\Support\ServiceProvider;
use LogicException;

class GedmoExtensionsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        if (!$this->app->bound('registry')) {
            throw new LogicException('[GedmoExtensionServiceProvider] requires [LaravelDoctrine\ORM\DoctrineServiceProvider] to be registered first');
        }

        $registry = $this->app->make('registry');

        foreach ($registry->getManagers() as $manager) {
            $chain  = $manager->getConfiguration()->getMetadataDriverImpl();
            $reader = $chain->getReader();

            if ($reader instanceof Reader) {
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
    }
}
