<?php

namespace Vivaster\Customer\Domain\Model\Customer;

/**
 * Interface CustomerRepository.
 */
interface CustomerRepository
{
    /**
     * @param int $customerId
     * @return Customer|null
     */
    public function ofId($customerId);

    /**
     * @param Customer $customer
     * @return void
     */
    public function save(Customer $customer);
}

