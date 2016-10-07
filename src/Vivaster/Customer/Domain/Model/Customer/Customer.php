<?php

namespace Vivaster\Customer\Domain\Model\Customer;

class Customer
{
    private $id;

    private $name;

    private $country;

    private $street;

    public function __construct($id, $name, $country, $street)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->country  = $country;
        $this->street   = $street;
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function country()
    {
        return $this->country;
    }

    public function street()
    {
        return $this->street;
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

    public function move($country = null, $street = null)
    {
        $moved = false;

        if (isset($country)) {
            $country = trim($country);

            if ($this->country !== $country) {
                $this->country = $country;
                $moved = true;
            }
        }

        if (isset($street)) {
            $street  = trim($street);

            if ($this->street !== $street) {
                $this->street = $street;
                $moved = true;
            }
        }

        if ($moved) {
            // fire an event
            return true;
        }

        return false;
    }
}