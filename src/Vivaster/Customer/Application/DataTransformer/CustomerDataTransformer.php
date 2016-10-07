<?php

namespace Vivaster\Customer\Application\DataTransformer;

use Vivaster\Customer\Domain\Model\Customer\Customer;

/**
 * Class CustomerDataTransformer
 */
abstract class CustomerDataTransformer
{
    /**
     * @var mixed
     */
    protected $data;

    /**
     * @param Customer $customer
     * @return void
     */
    abstract public function write(Customer $customer);

    /**
     * @return mixed
     */
    public function read()
    {
        return $this->data;
    }
}