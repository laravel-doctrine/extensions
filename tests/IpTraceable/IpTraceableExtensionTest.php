<?php

use Illuminate\Http\Request;
use LaravelDoctrine\Extensions\IpTraceable\IpTraceableExtension;
use Mockery as m;

class IpTraceableExtensionTest extends ExtensionTestCase
{
    public function test_can_register_extension()
    {
        $request = m::mock(Request::class);

        $request->shouldReceive('getClientIp')
            ->once()->andReturn('127.0.0.1');

        $extension = new IpTraceableExtension(
            $request
        );

        $extension->addSubscribers(
            $this->evm,
            $this->em,
            $this->reader
        );

        $this->assertEmpty($extension->getFilters());
    }
}
