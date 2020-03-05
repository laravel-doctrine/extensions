<?php

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManagerInterface;
use Mockery as m;

abstract class ExtensionTestCase extends TestCase
{
    /**
     * @var \Mockery\MockInterface|EventManager
     */
    protected $evm;

    /**
     * @var \Mockery\MockInterface|EntityManagerInterface
     */
    protected $em;

    /**
     * @var \Mockery\MockInterface|Reader
     */
    protected $reader;

    public function setUp(): void
    {
        $this->evm = m::mock(EventManager::class);
        $this->evm->shouldReceive('addEventSubscriber')->once();

        $this->em     = m::mock(EntityManagerInterface::class);
        $this->reader = m::mock(Reader::class);
    }
    public function tearDown(): void
    {
        m::close();
    }
}
