<?php

namespace Vivaster\Customer\Application;

/**
 * Class ViewCustomerRequest
 */
class ViewCustomerRequest
{
    /**
     * @var string
     */
    private $customerId;

    /**
     * @param string $customerId
     */
    public function __construct($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return string
     */
    public function customerId()
    {
        return $this->customerId;
    }
}