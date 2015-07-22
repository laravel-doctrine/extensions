<?php

namespace LaravelDoctrine\ORM;

use Gedmo\DoctrineExtensions;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\Extensions\DriverChain;

/**
 * Class BeberleiExtensionsServiceProvider
 * @package LaravelDoctrine\ORM
 */
class BeberleiExtensionsServiceProvider extends ServiceProvider
{

    /**
     * Register the metadata
     */
    public function boot()
    {
        throw new \Exception('Not yet implemented.');

        // I think the process would be:

        // Get Entity Managers

        // For each Entity Manager if DQL is not empty/null

            // Set custom functions defined in DQL configuration


        // Here is some code for reference from another repo implementing these:

        /**
        if(!is_null($dql) && !empty($dql)){
            //crude check to see if package is installed so we can give a helpful error message
            if(!file_exists(base_path() . '/vendor/beberlei/DoctrineExtensions/composer.json')){
                throw new RuntimeException('DoctrineExtensions is not installed!');
            }
            //check for function arrays and load them
            if(isset($dql['datetime_functions'])){
                $metadata->setCustomDatetimeFunctions($dql['datetime_functions']);
            }
            if(isset($dql['numeric_functions'])){
                $metadata->setCustomNumericFunctions($dql['numeric_functions']);
            }
            if(isset($dql['string_functions'])){
                $metadata->setCustomStringFunctions($dql['string_functions']);
            }
        }
        **/
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