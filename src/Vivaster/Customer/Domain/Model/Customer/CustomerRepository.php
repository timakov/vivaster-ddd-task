<?php

namespace Vivaster\Customer\Domain\Model\Customer;

/**
 * Interface CustomerRepository.
 */
interface CustomerRepository
{
    /**
     * @param CustomerId $customerId
     * @return Customer|null
     */
    public function ofId(CustomerId $customerId);

    /**
     * @param Customer $customer
     * @return void
     */
    public function persist(Customer $customer);
}

