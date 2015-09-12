<?php

use Gedmo\Uploadable\UploadableListener;
use Illuminate\Contracts\Foundation\Application;
use LaravelDoctrine\Extensions\Uploadable\UploadableExtensionServiceProvider;
use Mockery as m;

class UploadableExtensionServiceProviderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Mockery\MockInterface|Application
     */
    protected $app;

    /**
     * @var \Mockery\MockInterface|BeberleiExtensionsServiceProvider
     */
    protected $provider;

    public function setUp()
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
    }

    public function tearDown()
    {
        m::close();
    }
}
