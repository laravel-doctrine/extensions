<?php

namespace LaravelDoctrine\Extensions;

use Doctrine\Common\Annotations\Reader;
use Doctrine\ORM\Configuration;
use Gedmo\DoctrineExtensions;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\DoctrineManager;

class GedmoExtensionsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->app['events']->listen('doctrine.extensions.booting', function () {

            $this->app->make(DoctrineManager::class)->extendAll(function (Configuration $configuration) {

                $chain  = $configuration->getMetadataDriverImpl();
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
            });
        });
    }
}
