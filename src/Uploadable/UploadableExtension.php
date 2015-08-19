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
     * @param EventManager           $manager
     * @param EntityManagerInterface $em
     * @param Reader                 $reader
     */
    public function addSubscribers(EventManager $manager, EntityManagerInterface $em, Reader $reader = null)
    {
        if (!\App::bound('uploadableListener'))
        {
            throw new \Exception('Binding "uploadableListener" not found. Please register the UploadableServiceProvider in your application.');
        }
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
