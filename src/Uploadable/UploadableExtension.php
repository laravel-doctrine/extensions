<?php

namespace LaravelDoctrine\Extensions\Uploadable;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Uploadable\UploadableListener;
use LaravelDoctrine\ORM\Extensions\Extension;

class UploadableExtension implements Extension
{
    /**
     * @var UploadableListener
     */
    protected $listener;

    /**
     * @param UploadableListener $listener
     */
    public function __construct(UploadableListener $listener)
    {
        $this->listener = $listener;
    }

    /**
     * @param EventManager           $manager
     * @param EntityManagerInterface $em
     * @param Reader                 $reader
     */
    public function addSubscribers(EventManager $manager, EntityManagerInterface $em, Reader $reader = null)
    {
        if ($reader) {
            $this->listener->setAnnotationReader($reader);
        }

        $manager->addEventSubscriber($this->listener);
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [];
    }
}
