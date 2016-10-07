<?php

namespace Vivaster\Customer\Application\DataTransformer;

use Vivaster\Customer\Domain\Model\Customer\Customer;

/**
 * Class CustomerJsonDataTransformer
 */
class CustomerJsonDataTransformer extends CustomerDataTransformer
{
    /**
     * {@inheritdoc}
     */
    public function write(Customer $customer)
    {
        $customerDto = new \stdClass();

        $customerDto->name      = $customer->name();
        $customerDto->country   = $customer->address()->country();
        $customerDto->city      = $customer->address()->street();

        $this->data = json_encode($customerDto);
    }
}