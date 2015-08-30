<?php

use LaravelDoctrine\Extensions\Tree\NestedSet;

class NestedSetTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var NestedSetEntity
     */
    protected $entity;

    public function setUp()
    {
        $this->entity = new NestedSetEntity();
    }

    public function test_can_set_root()
    {
        $this->entity->setRoot(10);

        $this->assertEquals(10, $this->entity->getRoot());
    }

    public function test_can_set_level()
    {
        $this->entity->setLevel(5);

        $this->assertEquals(5, $this->entity->getLevel());
    }

    public function test_can_set_left()
    {
        $this->entity->setLeft(3);

        $this->assertEquals(3, $this->entity->getLeft());
    }

    public function test_can_set_right()
    {
        $this->entity->setRight(2);

        $this->assertEquals(2, $this->entity->getRight());
    }
}

class NestedSetEntity
{
    use NestedSet;
}
