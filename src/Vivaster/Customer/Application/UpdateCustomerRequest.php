<?php

namespace Vivaster\Customer\Application;

/**
 * Class UpdateCustomerRequest
 */
class UpdateCustomerRequest
{
    /**
     * @var string
     */
    private $customerId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $street;

    /**
     * @param string $customerId
     * @param array $customerData
     */
    public function __construct($customerId, array $customerData = [])
    {
        $this->customerId = $customerId;

        if (isset($customerData['name'])) {
            $this->name = $customerData['name'];
        }

        if (isset($customerData['country'])) {
            $this->country = $customerData['country'];
        }

        if (isset($customerData['street'])) {
            $this->street = $customerData['street'];
        }
    }

    /**
     * @return string
     */
    public function customerId()
    {
        return $this->customerId;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
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
}