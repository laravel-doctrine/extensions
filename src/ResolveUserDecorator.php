<?php

namespace LaravelDoctrine\Extensions;

use Doctrine\Common\EventSubscriber;

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
     * @param EventSubscriber $wrapped
     * @param string          $userSetterMethod
     */
    public function __construct(EventSubscriber $wrapped, $userSetterMethod)
    {
        $this->wrapped          = $wrapped;
        $this->userSetterMethod = $userSetterMethod;
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
        if ($method !== 'loadClassMetadata' && $this->getGuard()->check()) {
            call_user_func([$this->wrapped, $this->userSetterMethod], $this->getGuard()->user());
        }

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

    /**
     * Get the class of extension event subscriber.
     * Used to identify which event subscriber is wrapped by the resolver.
     *
     * @return string
     */
    public function getEventSubscriberClass()
    {
        return get_class($this->wrapped);
    }
    
    /**
    * Get current Auth manager.
    *
    * @return \Illuminate\Contracts\Auth\Guard
    */
    protected function getGuard()
    {
    	return app('auth')->guard();
    }
}
