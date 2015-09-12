<?php

namespace LaravelDoctrine\Extensions\Blameable;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Blameable\BlameableListener;
use Illuminate\Contracts\Auth\Guard;
use LaravelDoctrine\Extensions\GedmoExtension;

class BlameableExtension extends GedmoExtension
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
        $subscriber = new BlameableListener();

        if ($this->guard->check()) {
            $subscriber->setUserValue($this->guard->user());
        }

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
