<?php

namespace Vivaster\Customer\Application\DataTransformer;

use Vivaster\Customer\Domain\Model\Customer\Customer;

/**
 * Interface CustomerDataTransformer
 */
interface CustomerDataTransformer
{
    /**
     * @param Customer $customer
     * @return mixed
     */
    public function transform(Customer $customer);
}