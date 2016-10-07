<?php
namespace Vivaster\Customer\Domain\Model\Customer;

/**
 * Class CustomerId
 */
final class CustomerId
{
    /**
     * @var int
     */
    private $id;

    /**
     * CustomerId constructor.
     *
     * @param int $id
     */
    public function __construct($id)
    {
        $this->setId($id);
    }

    /**
     * @param CustomerId $customerId
     *
     * @return bool
     */
    public function equals(CustomerId $customerId)
    {
        return $this->id() === $customerId->id();
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    private function setId($id)
    {
        $this->id = (int)$id;
    }
}