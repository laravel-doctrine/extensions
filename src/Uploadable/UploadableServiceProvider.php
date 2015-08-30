<?php

namespace LaravelDoctrine\Extensions\Uploadable;

use Gedmo\Uploadable\UploadableListener;
use Illuminate\Support\ServiceProvider;

class UploadableServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UploadableListener::class, function () {

            return new UploadableListener();
        });
    }
}
