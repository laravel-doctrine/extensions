<?php

namespace LaravelDoctrine\Extensions\Loggable;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Loggable\LoggableListener;
use Illuminate\Contracts\Auth\Guard;
use LaravelDoctrine\ORM\Extensions\Extension;

class LoggableExtension implements Extension
{
    /**
     * @var Guard
     */
    protected $guard;

    /**
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * @param EventManager           $manager
     * @param EntityManagerInterface $em
     * @param Reader                 $reader
     */
    public function addSubscribers(EventManager $manager, EntityManagerInterface $em, Reader $reader = null)
    {
        $subscriber = new LoggableListener;

        if ($reader) {
            $subscriber->setAnnotationReader($reader);
        }

        if ($this->guard->check()) {
            $subscriber->setUsername(
                $this->guard->user()
            );
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
