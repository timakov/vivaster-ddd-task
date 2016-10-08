<?php

namespace Vivaster\Customer\Application\Event;

use Symfony\Component\EventDispatcher\Event;
use Vivaster\Customer\Domain\Model\Customer\CustomerId;

/**
 * Class CustomerRenamedEvent
 */
final class CustomerRenamedEvent extends Event
{
    const EVENT_NAME = 'customer.event.renamed';

    /**
     * @var CustomerId
     */
    private $customerId;

    /**
     * @var string
     */
    private $oldName;

    /**
     * @var string
     */
    private $newName;

    /**
     * CustomerRenamedEvent constructor.
     *
     * @param CustomerId $customerId
     * @param string $oldName
     * @param string $newName
     */
    public function __construct(CustomerId $customerId, $oldName, $newName)
    {
        $this->customerId   = $customerId;
        $this->oldName      = $oldName;
        $this->newName      = $newName;
    }

    /**
     * @return CustomerId
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @return string
     */
    public function getOldName()
    {
        return $this->oldName;
    }

    /**
     * @return string
     */
    public function getNewName()
    {
        return $this->newName;
    }
}