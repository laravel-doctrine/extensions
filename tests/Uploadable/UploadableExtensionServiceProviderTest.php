<?php

use PHPUnit\Framework\TestCase;
use Gedmo\Uploadable\UploadableListener;
use Illuminate\Contracts\Foundation\Application;
use LaravelDoctrine\Extensions\Uploadable\UploadableExtensionServiceProvider;
use Mockery as m;

class UploadableExtensionServiceProviderTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|Application
     */
    protected $app;

    /**
     * @var \Mockery\MockInterface|BeberleiExtensionsServiceProvider
     */
    protected $provider;

    public function setUp(): void
    {
        $this->app = m::mock(Application::class);

        $this->provider = new UploadableExtensionServiceProvider($this->app);
    }

    public function test_listener_gets_bound_as_singleton()
    {
        $this->app->shouldReceive('singleton')
                  ->once()
                  ->with(UploadableListener::class);

        $this->provider->register();

        // silence the 'This test did not perform any assertions' warning
        $this->assertTrue(true);
    }

    public function tearDown(): void
    {
        m::close();
    }
}
