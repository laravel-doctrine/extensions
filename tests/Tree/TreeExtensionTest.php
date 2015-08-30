<?php

use LaravelDoctrine\Extensions\Tree\TreeExtension;

class TreeExtensionTest extends ExtensionTestCase
{
    public function test_can_register_extension()
    {
        $extension = new TreeExtension();

        $extension->addSubscribers(
            $this->evm,
            $this->em,
            $this->reader
        );

        $this->assertEmpty($extension->getFilters());
    }
}
