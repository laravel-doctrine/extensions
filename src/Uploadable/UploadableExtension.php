<?php

namespace LaravelDoctrine\Extensions\Uploadable;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Uploadable\UploadableListener;
use LaravelDoctrine\ORM\Extensions\Extension;

class UploadableExtension implements Extension
{
    public function register()
    {
        \App::singleton('uploadableListener', function() {

            return new UploadableListener();
        });
    }
    /**
     * @param EventManager           $manager
     * @param EntityManagerInterface $em
     * @param Reader                 $reader
     */
    public function addSubscribers(EventManager $manager, EntityManagerInterface $em, Reader $reader = null)
    {
        $subscriber = app('uploadableListener');
        $subscriber->setAnnotationReader($reader);
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
