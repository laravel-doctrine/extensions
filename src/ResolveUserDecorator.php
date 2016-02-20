<?php

namespace LaravelDoctrine\Extensions;

use Doctrine\Common\EventSubscriber;
use Gedmo\Mapping\MappedEventSubscriber;

class ResolveUserDecorator implements EventSubscriber
{
    /**
     * @var MappedEventSubscriber
     */
    private $wrapped;

    /**
     * @var callable
     */
    private $user;

    /**
     * @var string
     */
    private $userSetterMethod;

    /**
     * ResolveUserDecorator constructor.
     * @param MappedEventSubscriber $wrapped
     * @param string                $userSetterMethod
     */
    public function __construct(MappedEventSubscriber $wrapped, $userSetterMethod)
    {
        $this->wrapped          = $wrapped;
        $this->userSetterMethod = $userSetterMethod;
    }

    /**
     * @param callable $user
     */
    public function setUserResolver(callable $user)
    {
        $this->user = $user;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return $this->wrapped->getSubscribedEvents();
    }

    /**
     * @param  string $method
     * @param  array  $params
     * @return mixed
     */
    public function __call($method, $params)
    {
        $resolver = $this->user;

        call_user_func([$this->wrapped, $this->userSetterMethod], $resolver());

        return call_user_func_array([$this->wrapped, $method], $params);
    }
}
