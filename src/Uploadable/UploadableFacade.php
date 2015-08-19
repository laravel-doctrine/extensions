<?php
/**
 * Created by PhpStorm.
 * User: jee7
 * Date: 6.08.15
 * Time: 10:10
 */

namespace LaravelDoctrine\Extensions\Uploadable;


use Illuminate\Support\Facades\Facade;

class UploadableFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'uploadableListener'; }
} 