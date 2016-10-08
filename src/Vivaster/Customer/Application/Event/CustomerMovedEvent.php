<?php

namespace Vivaster\Customer\Application\Event;

use Symfony\Component\EventDispatcher\Event;
use Vivaster\Customer\Domain\Model\Customer\CustomerId;
use Vivaster\Customer\Domain\Common\Address;

/**
 * Class CustomerMovedEvent
 */
final class CustomerMovedEvent extends Event
{
    const EVENT_NAME = 'customer.event.relocated';

    /**
     * @var CustomerId
     */
    private $customerId;

    /**
     * @var Address
     */
    private $oldAddress;

    /**
     * @var Address
     */
    private $newAddress;

    /**
     * CustomerRenamedEvent constructor.
     *
     * @param CustomerId $customerId
     * @param Address $oldAddress
     * @param Address $newAddress
     */
    public function __construct(CustomerId $customerId, Address $oldAddress, Address $newAddress)
    {
        $this->customerId   = $customerId;
        $this->oldAddress   = $oldAddress;
        $this->newAddress   = $newAddress;
    }

    /**
     * @return CustomerId
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @return Address
     */
    public function getOldAddress()
    {
        return $this->oldAddress;
    }

    /**
     * @return Address
     */
    public function getNewAddress()
    {
        return $this->newAddress;
    }

}