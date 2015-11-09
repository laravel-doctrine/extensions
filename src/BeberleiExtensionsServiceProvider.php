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
        'DATE'              => Mysql\Date::class,
        'DATE_FORMAT'       => Mysql\DateFormat::class,
        'DATEADD'           => Mysql\Dateadd::class,
        'DATEDIFF'          => Mysql\Datediff::class,
        'DATESUB'           => Mysql\Datesub::class,
        'DAY'               => Mysql\Day::class,
        'DAYNAME'           => Mysql\Dayname::class,
        'FROM_UNIXTIME'     => Mysql\FromUnixtime::class,
        'HOUR'              => Mysql\Hour::class,
        'LAST_DAY'          => Mysql\LastDay::class,
        'MINUTE'            => Mysql\Minute::class,
        'MONTH'             => Mysql\Month::class,
        'MONTHNAME'         => Mysql\Monthname::class,
        'SECOND'            => Mysql\Second::class,
        'STRTODATE'         => Mysql\Strtodate::class,
        'TIME'              => Mysql\Time::class,
        'TIMESTAMPADD'      => Mysql\Timestampadd::class,
        'TIMESTAMPDIFF'     => Mysql\Timestampdiff::class,
        'WEEK'              => Mysql\Week::class,
        'WEEKDAY'           => Mysql\Weekday::class,
        'YEAR'              => Mysql\Year::class,
    ];

    /**
     * @var array
     */
    protected $numeric = [
        'ACOS'          => Mysql\Acos::class,
        'ASIN'          => Mysql\Asin::class,
        'ATAN'          => Mysql\Atan::class,
        'ATAN2'         => Mysql\Atan2::class,
        'BINARY'        => Mysql\Binary::class,
        'CEIL'          => Mysql\Ceil::class,
        'COS'           => Mysql\Cos::class,
        'COT'           => Mysql\Cot::class,
        'COUNTIF'       => Mysql\Countif::class,
        'CRC32'         => Mysql\Crc32::class,
        'DEGREES'       => Mysql\Degrees::class,
        'FLOOR'         => Mysql\Floor::class,
        'IFELSE'        => Mysql\Ifelse::class,
        'IFNULL'        => Mysql\Ifnull::class,
        'MATCH_AGAINST' => Mysql\MatchAgainst::class,
        'NULLIF'        => Mysql\Nullif::class,
        'PI'            => Mysql\Pi::class,
        'POWER'         => Mysql\Power::class,
        'QUARTER'       => Mysql\Quarter::class,
        'RADIANS'       => Mysql\Radians::class,
        'RAND'          => Mysql\Rand::class,
        'ROUND'         => Mysql\Round::class,
        'SIN'           => Mysql\Sin::class,
        'STD'           => Mysql\Std::class,
        'TAN'           => Mysql\Ta::class,
        'UUID_SHORT'    => Mysql\UuidShort::class,
    ];

    /**
     * @var array
     */
    protected $string = [
        'ASCII'             => Mysql\Ascii::class,
        'CHAR_LENGTH'       => Mysql\CharLength::class,
        'CONCAT_WS'         => Mysql\ConcatWs::class,
        'FIELD'             => Mysql\Field::class,
        'FIND_IN_SET'       => Mysql\FindInSet::class,
        'GROUP_CONCAT'      => Mysql\GroupConcat::class,
        'MD5'               => Mysql\Md5::class,
        'REGEXP'            => Mysql\Regexp::class,
        'REPLACE'           => Mysql\Replace::class,
        'SHA1'              => Mysql\Sha1::class,
        'SHA2'              => Mysql\Sha2::class,
        'SOUNDEX'           => Mysql\Soundex::class,
        'SUBSTRING_INDEX'   => Mysql\SubstringIndex::class,
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
