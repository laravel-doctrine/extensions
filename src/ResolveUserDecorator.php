<?php

namespace LaravelDoctrine\Extensions;

use Doctrine\Common\EventSubscriber;
use Illuminate\Contracts\Auth\Guard;

class ResolveUserDecorator implements EventSubscriber
{
    /**
     * @var EventSubscriber
     */
    private $wrapped;

    /**
     * @var string
     */
    private $userSetterMethod;

    /**
     * @var Guard
     */
    private $auth;

    /**
     * @param EventSubscriber $wrapped
     * @param Guard           $auth
     * @param string          $userSetterMethod
     */
    public function __construct(EventSubscriber $wrapped, Guard $auth, $userSetterMethod)
    {
        $this->wrapped          = $wrapped;
        $this->userSetterMethod = $userSetterMethod;
        $this->auth             = $auth;
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
     * Set annotation reader class
     * since older doctrine versions do not provide an interface
     * it must provide these methods:
     *     getClassAnnotations([reflectionClass])
     *     getClassAnnotation([reflectionClass], [name])
     *     getPropertyAnnotations([reflectionProperty])
     *     getPropertyAnnotation([reflectionProperty], [name])
     *
     * @param Reader $reader - annotation reader class
     */
    public function setAnnotationReader($reader)
    {
        $this->wrapped->setAnnotationReader($reader);
    }

    /**
     * @param  string $method
     * @param  array  $params
     * @return mixed
     */
    public function __call($method, $params)
    {
        call_user_func([$this->wrapped, $this->userSetterMethod], $this->auth->user());

        return call_user_func_array([$this->wrapped, $method], $params);
    }

    /**
     * Get the namespace of extension event subscriber.
     * used for cache id of extensions also to know where
     * to find Mapping drivers and event adapters
     *
     * @return string
     */
    protected function getNamespace()
    {
        return $this->wrapped->getNamespace();
    }
}
