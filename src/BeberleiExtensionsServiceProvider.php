<?php

namespace LaravelDoctrine\Extensions;

use Illuminate\Support\ServiceProvider;

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
