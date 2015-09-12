<?php

namespace LaravelDoctrine\Extensions;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventManager;
use Gedmo\Mapping\MappedEventSubscriber;
use LaravelDoctrine\ORM\Extensions\Extension as ExtensionContract;

abstract class GedmoExtension implements ExtensionContract
{
    /**
     * @param MappedEventSubscriber $subscriber
     * @param EventManager          $manager
     * @param Reader|null           $reader
     */
    protected function addSubscriber(MappedEventSubscriber $subscriber, EventManager $manager, Reader $reader = null)
    {
        if ($reader) {
            $subscriber->setAnnotationReader($reader);
        }

        $manager->addEventSubscriber($subscriber);
    }
}
