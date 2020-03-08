<?php

use PHPUnit\Framework\TestCase;
use Illuminate\Contracts\Foundation\Application;
use LaravelDoctrine\Extensions\BeberleiExtensionsServiceProvider;
use LaravelDoctrine\ORM\DoctrineManager;
use Mockery as m;

class BeberleiExtensionsServiceProviderTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|Application
     */
    protected $app;

    /**
     * @var \Mockery\MockInterface|BeberleiExtensionsServiceProvider
     */
    protected $provider;

    /**
     * @var \Mockery\MockInterface|DoctrineManager
     */
    protected $manager;

    public function setUp(): void
    {
        $this->app     = m::mock(Application::class);
        $this->manager = m::mock(DoctrineManager::class);

        $this->provider = new BeberleiExtensionsServiceProvider($this->app);

        // silence the 'This test did not perform any assertions' warning
        $this->assertTrue(true);
    }

    public function test_custom_functions_can_be_registered()
    {
        $this->manager->shouldReceive('extendAll')->once();

        $this->provider->boot($this->manager);
    }

    public function tearDown(): void
    {
        m::close();
    }
}
