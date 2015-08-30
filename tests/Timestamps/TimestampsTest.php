<?php

use LaravelDoctrine\Extensions\Timestamps\Timestamps;

class TimestampsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var TimestampsEntity
     */
    protected $entity;

    public function setUp()
    {
        $this->entity = new TimestampsEntity();
    }

    public function test_can_set_created_at()
    {
        $date = new DateTime('now');

        $this->entity->setCreatedAt($date);

        $this->assertEquals($date, $this->entity->getCreatedAt());
    }

    public function test_can_set_updated_at()
    {
        $date = new DateTime('now');

        $this->entity->setUpdatedAt($date);

        $this->assertEquals($date, $this->entity->getUpdatedAt());
    }
}

class TimestampsEntity
{
    use Timestamps;
}
