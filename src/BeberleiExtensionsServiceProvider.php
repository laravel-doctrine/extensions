<?php

namespace LaravelDoctrine\Extensions;

use Doctrine\ORM\Configuration;
use DoctrineExtensions\Query\Mysql;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\DoctrineManager;

class BeberleiExtensionsServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $datetime = [
        'DATEADD'  => Mysql\DateAdd::class,
        'DATEDIFF' => Mysql\DateDiff::class
    ];

    /**
     * @var array
     */
    protected $numeric = [
        'ACOS'    => Mysql\Acos::class,
        'ASIN'    => Mysql\Asin::class,
        'ATAN'    => Mysql\Atan::class,
        'ATAN2'   => Mysql\Atan2::class,
        'COS'     => Mysql\Cos::class,
        'COT'     => Mysql\Cot::class,
        'DEGREES' => Mysql\Degrees::class,
        'RADIANS' => Mysql\Radians::class,
        'SIN'     => Mysql\Sin::class,
        'TAN'     => Mysql\Ta::class
    ];

    /**
     * @var array
     */
    protected $string = [
        'CHAR_LENGTH' => Mysql\CharLength::class,
        'CONCAT_WS'   => Mysql\ConcatWs::class,
        'FIELD'       => Mysql\Field::class,
        'FIND_IN_SET' => Mysql\FindInSet::class,
        'REPLACE'     => Mysql\Replace::class,
        'SOUNDEX'     => Mysql\Soundex::class,
        'STR_TO_DATE' => Mysql\StrToDat::class
    ];

    /**
     * Register the metadata
     *
     * @param DoctrineManager $manager
     */
    public function boot(DoctrineManager $manager)
    {
        $manager->extendAll(function (Configuration $configuration) {
            $configuration->setCustomDatetimeFunctions($this->datetime);
            $configuration->setCustomNumericFunctions($this->numeric);
            $configuration->setCustomStringFunctions($this->string);
        });
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
    }
}
