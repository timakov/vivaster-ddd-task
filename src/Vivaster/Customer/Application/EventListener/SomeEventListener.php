<?php

namespace Vivaster\Customer\Application\EventListener;

use Vivaster\Customer\Application\Event\CustomerRenamedEvent;
use Vivaster\Customer\Application\Event\CustomerMovedEvent;

class SomeEventListener
{
    public function doSomething1(CustomerRenamedEvent $event)
    {

    }

    public function doSomething2(CustomerMovedEvent $event)
    {

    }
}