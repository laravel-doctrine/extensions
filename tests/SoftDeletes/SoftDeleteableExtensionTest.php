<?php

use Gedmo\SoftDeleteable\Filter\SoftDeleteableFilter;
use LaravelDoctrine\Extensions\SoftDeletes\SoftDeleteableExtension;

class SoftDeleteableExtensionTest extends ExtensionTestCase
{
    public function test_can_register_extension()
    {
        $extension = new SoftDeleteableExtension();

        $extension->addSubscribers(
            $this->evm,
            $this->em,
            $this->reader
        );

        $this->assertContains(SoftDeleteableFilter::class, $extension->getFilters());
    }
}
