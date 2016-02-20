<?php

use Illuminate\Contracts\Auth\Guard;
use LaravelDoctrine\Extensions\Loggable\LoggableExtension;
use Mockery as m;

class LoggableExtensionTest extends ExtensionTestCase
{
    public function test_can_register_extension()
    {
        $guard = m::mock(Guard::class);

        $extension = new LoggableExtension(
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
