<?php

namespace LaravelDoctrine\Extensions\Sluggable;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Sluggable\SluggableListener;
use LaravelDoctrine\ORM\Extensions\Extension;

class SluggableExtension implements Extension
{
    /**
     * @param EventManager           $manager
     * @param EntityManagerInterface $em
     * @param Reader                 $reader
     */
    public function addSubscribers(EventManager $manager, EntityManagerInterface $em, Reader $reader = null)
    {
        $subscriber = new SluggableListener;

        if ($reader) {
            $subscriber->setAnnotationReader($reader);
        }

        $manager->addEventSubscriber($subscriber);
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [];
    }
}
