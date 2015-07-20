<?php

namespace LaravelDoctrine\ORM\Extensions\Timestamps;

use LaravelDoctrine\ORM\Extensions\Extension;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Timestampable\TimestampableListener;
use LaravelDoctrine\ORM\Extensions\GedmoExtension;

class TimestampableExtension extends GedmoExtension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return [];
    }

    protected function execute(EventManager $manager, EntityManagerInterface $em, Reader $reader = null)
    {
        $subscriber = new TimestampableListener;
        $subscriber->setAnnotationReader($reader);
        $manager->addEventSubscriber($subscriber);
    }
}
