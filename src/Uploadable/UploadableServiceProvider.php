<?php
/**
 * Created by PhpStorm.
 * User: jee7
 * Date: 19.08.15
 * Time: 17:14
 */

namespace LaravelDoctrine\Extensions\Uploadable;


use Gedmo\Uploadable\UploadableListener;
use Illuminate\Support\ServiceProvider;

class UploadableServiceProvider extends ServiceProvider {

    public function register() {

        \App::singleton('uploadableListener', function() {

            return new UploadableListener();
        });
    }
} 