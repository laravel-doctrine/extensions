<?php
/**
 * Created by PhpStorm.
 * User: jee7
 * Date: 6.08.15
 * Time: 10:10
 */

namespace LaravelDoctrine\Extensions\Uploadable;


class Uploadable {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'uploadableListener'; }
} 