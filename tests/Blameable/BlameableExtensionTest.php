<?php

use Illuminate\Contracts\Auth\Guard;
use LaravelDoctrine\Extensions\Blameable\BlameableExtension;
use Mockery as m;

class BlameableExtensionTest extends ExtensionTestCase
{
    public function test_can_register_extension()
    {
        $guard = m::mock(Guard::class);

        $extension = new BlameableExtension(
            $guard
        );

        $extension->addSubscribers(
            $this->evm,
            $this->em,
            $this->reader
        );

        $this->assertEmpty($extension->getFilters());
    }
}
