<?php

namespace LaravelDoctrine\Extensions\Loggable;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Loggable\LoggableListener;
use Illuminate\Contracts\Auth\Guard;
use LaravelDoctrine\Extensions\GedmoExtension;
use LaravelDoctrine\Extensions\ResolveUserDecorator;

class LoggableExtension extends GedmoExtension
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
        $subscriber = new ResolveUserDecorator(
            new LoggableListener,
            'setUsername'
        );

        $subscriber->setUserResolver(function () {
            $this->guard->user();
        });

        $this->addSubscriber($subscriber, $manager, $reader);
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [];
    }
}
