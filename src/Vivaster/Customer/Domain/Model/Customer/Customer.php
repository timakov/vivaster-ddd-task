<?php

namespace Vivaster\Customer\Domain\Model\Customer;

use Vivaster\Customer\Domain\Common\Address;

class Customer
{
    private $id;

    private $name;

    /**
     * @var Address
     */
    private $address;

    public function __construct($id, $name, Address $address)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->address  = $address;
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    /**
     * @return Address
     */
    public function address()
    {
        return $this->address;
    }

    public function rename($name)
    {
        if (!isset($name)) {
            return false;
        }

        $name = trim($name);

        if ($this->name !== $name) {
            $this->name = $name;

            // fire an event
            return true;
        }

        return false;
    }

    /**
     * @param Address $address
     *
     * @return bool
     */
    public function move(Address $address)
    {
        if ($this->address()->equals($address)) {
            return false;
        }

        $this->setAddress($address);

        // fire an event

        return true;
    }

    /**
     * @param Address $address
     */
    private function setAddress(Address $address)
    {
        $this->address = $address;
    }
}