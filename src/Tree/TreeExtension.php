<?php

namespace LaravelDoctrine\Extensions\Tree;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Tree\TreeListener;
use LaravelDoctrine\ORM\Extensions\Extension;

class TreeExtension implements Extension
{
    /**
     * @param EventManager           $manager
     * @param EntityManagerInterface $em
     * @param Reader                 $reader
     */
    public function addSubscribers(EventManager $manager, EntityManagerInterface $em, Reader $reader = null)
    {
        $subscriber = new TreeListener;

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
