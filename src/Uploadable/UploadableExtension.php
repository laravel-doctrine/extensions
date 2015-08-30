<?php

namespace LaravelDoctrine\Extensions\Uploadable;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Uploadable\UploadableListener;
use LaravelDoctrine\ORM\Extensions\Extension;

class UploadableExtension implements Extension
{
    public function __construct(UploadableListener $uploadableListener)
    {
        $this->uploadableListener = $uploadableListener;
    }

    /**
     * @param EventManager           $manager
     * @param EntityManagerInterface $em
     * @param Reader                 $reader
     */
    public function addSubscribers(EventManager $manager, EntityManagerInterface $em, Reader $reader = null)
    {
        $this->uploadableListener->setAnnotationReader($reader);
        $manager->addEventSubscriber($this->uploadableListener);
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [];
    }
}
