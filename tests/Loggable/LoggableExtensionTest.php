<?php

use Illuminate\Contracts\Auth\Guard;
use LaravelDoctrine\Extensions\Loggable\LoggableExtension;
use Mockery as m;

class LoggableExtensionTest extends ExtensionTestCase
{
    public function test_can_register_extension()
    {
        $guard = m::mock(Guard::class);

        $guard->shouldReceive('check')
              ->once()->andReturn('true');
        $guard->shouldReceive('user')
              ->once()->andReturn('user');

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
