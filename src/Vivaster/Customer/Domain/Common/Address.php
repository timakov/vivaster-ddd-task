<?php

namespace Vivaster\Customer\Domain\Common;

/**
 * Class Address
 */
final class Address
{
    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $street;

    /**
     * Address constructor.
     *
     * @param string $country
     * @param string $street
     */
    public function __construct($country, $street)
    {
        $this->setCountry($country);
        $this->setStreet($street);
    }

    /**
     * @param Address $address
     * @return bool
     */
    public function equals(Address $address)
    {
        return
            $this->country() === $address->country()
            && $this->street() === $address->street()
        ;
    }

    /**
     * @return string
     */
    public function country()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function street()
    {
        return $this->street;
    }

    /**
     * @param string $country
     */
    private function setCountry($country)
    {
        $this->country = trim($country);
    }

    /**
     * @param string $street
     */
    private function setStreet($street)
    {
        $this->street = trim($street);
    }
}