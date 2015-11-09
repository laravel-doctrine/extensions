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
        'DATE'              => Mysql\DATE::class,
        'DATE_FORMAT'       => Mysql\DATE_FORMAT::class,
        'DATEADD'           => Mysql\DATEADD::class,
        'DATEDIFF'          => Mysql\DATEDIFF::class,
        'DATESUB'           => Mysql\DATESUB::class,
        'DAY'               => Mysql\DAY::class,
        'DAYNAME'           => Mysql\DAYNAME::class,
        'FROM_UNIXTIME'     => Mysql\FROM_UNIXTIME::class,
        'HOUR'              => Mysql\HOUR::class,
        'LAST_DAY'          => Mysql\LAST_DAY::class,
        'MINUTE'            => Mysql\MINUTE::class,
        'MONTH'             => Mysql\MONTH::class,
        'MONTHNAME'         => Mysql\MONTHNAME::class,
        'SECOND'            => Mysql\SECOND::class,
        'STRTODATE'         => Mysql\STRTODATE::class,
        'TIME'              => Mysql\TIME::class,
        'TIMESTAMPADD'      => Mysql\TIMESTAMPADD::class,
        'TIMESTAMPDIFF'     => Mysql\TIMESTAMPDIFF::class,
        'WEEK'              => Mysql\WEEK::class,
        'WEEKDAY'           => Mysql\WEEKDAY::class,
        'YEAR'              => Mysql\YEAR::class,
    ];

    /**
     * @var array
     */
    protected $numeric = [
        'ACOS'          => Mysql\Acos::class,
        'ASIN'          => Mysql\Asin::class,
        'ATAN'          => Mysql\Atan::class,
        'ATAN2'         => Mysql\Atan2::class,
        'BINARY'        => Mysql\BINARY::class,
        'CEIL'          => Mysql\CEIL::class,
        'COS'           => Mysql\Cos::class,
        'COT'           => Mysql\Cot::class,
        'COUNTIF'       => Mysql\COUNTIF::class,
        'CRC32'         => Mysql\CRC32::class,
        'DEGREES'       => Mysql\Degrees::class,
        'FLOOR'         => Mysql\FLOOR::class,
        'IFELSE'        => Mysql\IFELSE::class,
        'IFNULL'        => Mysql\IFNULL::class,
        'MATCH_AGAINST' => Mysql\MATCH_AGAINST::class,
        'NULLIF'        => Mysql\NULLIF::class,
        'PI'            => Mysql\PI::class,
        'POWER'         => Mysql\POWER::class,
        'QUARTER'       => Mysql\QUARTER::class,
        'RADIANS'       => Mysql\Radians::class,
        'RAND'          => Mysql\RAND::class,
        'ROUND'         => Mysql\ROUND::class,
        'SIN'           => Mysql\Sin::class,
        'STD'           => Mysql\STD::class,
        'TAN'           => Mysql\Ta::class,
        'UUID_SHORT'    => Mysql\UUID_SHORT::class,
    ];

    /**
     * @var array
     */
    protected $string = [
        'ASCII'             => Mysql\ASCII::class,
        'CHAR_LENGTH'       => Mysql\CharLength::class,
        'CONCAT_WS'         => Mysql\ConcatWs::class,
        'FIELD'             => Mysql\Field::class,
        'FIND_IN_SET'       => Mysql\FindInSet::class,
        'GROUP_CONCAT'      => Mysql\GROUP_CONCAT::class,
        'MD5'               => Mysql\MD5::class,
        'REGEXP'            => Mysql\REGEXP::class,
        'REPLACE'           => Mysql\Replace::class,
        'SHA1'              => Mysql\SHA1::class,
        'SHA2'              => Mysql\SHA2::class,
        'SOUNDEX'           => Mysql\Soundex::class,
        'SUBSTRING_INDEX'   => Mysql\SUBSTRING_INDEX::class,
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
