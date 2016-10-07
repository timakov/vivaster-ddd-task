<?php

namespace Vivaster\Customer\Application\DataTransformer;

use Vivaster\Customer\Domain\Model\Customer\Customer;

/**
 * Class CustomerJsonDataTransformer
 */
class CustomerJsonDataTransformer implements CustomerDataTransformer
{
    /**
     * {@inheritdoc}
     */
    public function transform(Customer $customer)
    {
        $customerDto = new \stdClass();

        $customerDto->name      = $customer->name();
        $customerDto->country   = $customer->address()->country();
        $customerDto->city      = $customer->address()->street();

        return json_encode($customerDto);
    }
}