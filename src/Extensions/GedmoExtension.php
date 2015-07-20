<?php

namespace LaravelDoctrine\ORM\Extensions;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManagerInterface;

abstract class GedmoExtension implements Extension {

    /**
     * @var DriverChain
     */
    protected $driverChain;

    public function __construct(DriverChain $driverChain)
    {
        $this->driverChain = $driverChain;
    }

    /**
     * @param EventManager $manager
     * @param EntityManagerInterface $em
     * @param Reader|null $reader
     */
    public function addSubscribers(EventManager $manager, EntityManagerInterface $em, Reader $reader = null){
        DoctrineExtensions::registerAbstractMappingIntoDriverChainORM(
            $this->driverChain->getChain(),
            $reader
        );

        $this->execute($manager, $em, $reader);
    }

    /**
     * @param EventManager $manager
     * @param EntityManagerInterface $em
     * @param Reader|null $reader
     * @return mixed
     */
    abstract protected function execute(EventManager $manager, EntityManagerInterface $em, Reader $reader = null);

}