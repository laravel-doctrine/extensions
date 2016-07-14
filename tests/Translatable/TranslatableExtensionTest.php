<?php

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Foundation\Application;
use LaravelDoctrine\Extensions\Translatable\TranslatableExtension;
use Mockery as m;

class TranslatableExtensionTest extends ExtensionTestCase
{
    public function test_can_register_extension()
    {
        $app = m::mock(Application::class);
        $app->shouldReceive('getLocale')->once()->andReturn('en');

        $config = m::mock(Repository::class);
        $config->shouldReceive('get')
               ->with('app.locale')->once()
               ->andReturn('en');

        $events = m::mock(Dispatcher::class);
        $events->shouldReceive('listen')
            ->with('locale.changed', m::type('callable'))
            ->once();

        $extension = new TranslatableExtension($app, $config, $events);

        $extension->addSubscribers(
            $this->evm,
            $this->em,
            $this->reader
        );

        $this->assertEmpty($extension->getFilters());
    }
}
