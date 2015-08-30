<?php

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use LaravelDoctrine\Extensions\GedmoExtensionsServiceProvider;
use Mockery as m;

class GedmoExtensionsServiceProviderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Mockery\MockInterface|Application
     */
    protected $app;

    /**
     * @var \Mockery\MockInterface|ManagerRegistry
     */
    protected $registry;

    /**
     * @var \Mockery\MockInterface|GedmoExtensionsServiceProvider
     */
    protected $provider;

    /**
     * @var \Mockery\MockInterface|EntityManagerInterface
     */
    protected $em;

    /**
     * @var \Mockery\MockInterface|Configuration
     */
    protected $configuration;

    /**
     * @var \Mockery\MockInterface|Configuration
     */
    protected $chain;

    /**
     * @var \Mockery\MockInterface|Reader
     */
    protected $reader;

    /**
     * @var \Mockery\MockInterface|Repository
     */
    protected $config;

    public function setUp()
    {
        $this->app    = m::mock(Application::class);
        $this->config = m::mock(Repository::class);

        $this->registry      = m::mock(ManagerRegistry::class);
        $this->em            = m::mock(EntityManagerInterface::class);
        $this->configuration = m::mock(Configuration::class);
        $this->chain         = m::mock(MappingDriverChain::class);
        $this->reader        = m::mock(Reader::class);

        $this->provider = new GedmoExtensionsServiceProvider($this->app);
    }

    public function test_can_boot_service_provider_with_one_connection()
    {
        $this->registry
            ->shouldReceive('getManagers')
            ->once()->andReturn([
                'default' => $this->em
            ]);

        $this->em
            ->shouldReceive('getConfiguration')
            ->once()->andReturn($this->configuration);

        $this->configuration
            ->shouldReceive('getMetadataDriverImpl')
            ->once()->andReturn($this->chain);

        $this->chain
            ->shouldReceive('getReader')
            ->once()->andReturn($this->reader);

        $this->chain
            ->shouldReceive('addDriver')
            ->once();

        $this->app
            ->shouldReceive('make')->with('config')
            ->once()
            ->andReturn($this->config);

        $this->config
            ->shouldReceive('get')
            ->with('doctrine.gedmo.all_mappings', false)
            ->once()
            ->andReturn(true);

        $this->provider->boot($this->registry);
    }

    public function test_can_boot_service_provider_with_two_connection()
    {
        $this->registry
            ->shouldReceive('getManagers')
            ->once()->andReturn([
                'default' => $this->em,
                'custom'  => $this->em
            ]);

        $this->em
            ->shouldReceive('getConfiguration')
            ->twice()->andReturn($this->configuration);

        $this->configuration
            ->shouldReceive('getMetadataDriverImpl')
            ->twice()->andReturn($this->chain);

        $this->chain
            ->shouldReceive('getReader')
            ->twice()->andReturn($this->reader);

        $this->chain
            ->shouldReceive('addDriver')
            ->twice();

        $this->app
            ->shouldReceive('make')->with('config')
            ->twice()
            ->andReturn($this->config);

        $this->config
            ->shouldReceive('get')
            ->with('doctrine.gedmo.all_mappings', false)
            ->twice()
            ->andReturn(true);

        $this->provider->boot($this->registry);
    }

    public function tearDown()
    {
        m::close();
    }
}
