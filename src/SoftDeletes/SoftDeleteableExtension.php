<?php

namespace LaravelDoctrine\Extensions\SoftDeletes;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\SoftDeleteable\Filter\SoftDeleteableFilter;
use Gedmo\SoftDeleteable\SoftDeleteableListener;
use LaravelDoctrine\ORM\Extensions\Extension;

class SoftDeleteableExtension implements Extension
{
    /**
     * @param EventManager           $manager
     * @param EntityManagerInterface $em
     * @param Reader                 $reader
     */
    public function addSubscribers(EventManager $manager, EntityManagerInterface $em, Reader $reader = null)
    {
        $subscriber = new SoftDeleteableListener();

        if ($reader) {
            $subscriber->setAnnotationReader($reader);
        }

        $manager->addEventSubscriber(
            $subscriber
        );
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            'soft-deleteable' => SoftDeleteableFilter::class
        ];
    }
}
