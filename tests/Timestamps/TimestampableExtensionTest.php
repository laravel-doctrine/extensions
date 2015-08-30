<?php

use LaravelDoctrine\Extensions\Timestamps\TimestampableExtension;

class TimestampableExtensionTest extends ExtensionTestCase
{
    public function test_can_register_extension()
    {
        $extension = new TimestampableExtension();

        $extension->addSubscribers(
            $this->evm,
            $this->em,
            $this->reader
        );

        $this->assertEmpty($extension->getFilters());
    }
}
