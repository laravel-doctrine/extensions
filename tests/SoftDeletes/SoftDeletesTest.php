<?php

use LaravelDoctrine\Extensions\SoftDeletes\SoftDeletes;

class SoftDeletesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SoftDeletesEntity
     */
    protected $entity;

    public function setUp()
    {
        $this->entity = new SoftDeletesEntity();
    }

    public function test_can_set_deleted_at()
    {
        $date = new DateTime('now');

        $this->entity->setDeletedAt($date);

        $this->assertEquals($date, $this->entity->getDeletedAt());
    }

    public function test_can_check_if_deleted()
    {
        $this->assertFalse($this->entity->isDeleted());

        $this->entity->setDeletedAt(new DateTime('now'));
        $this->assertTrue($this->entity->isDeleted());
    }

    public function test_can_restore()
    {
        $this->entity->setDeletedAt(new DateTime('now'));
        $this->assertTrue($this->entity->isDeleted());

        $this->entity->restore();
        $this->assertFalse($this->entity->isDeleted());
    }
}

class SoftDeletesEntity
{
    use SoftDeletes;
}
