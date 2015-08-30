<?php

use LaravelDoctrine\Extensions\Sluggable\SluggableExtension;

class SluggableExtensionTest extends ExtensionTestCase
{
    public function test_can_register_extension()
    {
        $extension = new SluggableExtension();

        $extension->addSubscribers(
            $this->evm,
            $this->em,
            $this->reader
        );

        $this->assertEmpty($extension->getFilters());
    }
}
