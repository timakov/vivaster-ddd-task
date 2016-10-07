<?php

namespace Vivaster\Customer\Infrastructure\Persistence;

use Vivaster\Customer\Domain\Model\Customer\Customer;
use Vivaster\Customer\Domain\Model\Customer\CustomerRepository;
use Vivaster\Customer\Domain\Model\Customer\CustomerId;

/**
 * Class InMemoryCustomerRepository
 */
class InMemoryCustomerRepository implements CustomerRepository
{
    /**
     * @var Customer[]
     */
    private $customers = [];

    /**
     * {@inheritdoc}
     */
    public function ofId(CustomerId $customerId)
    {
        $id = $customerId->id();

        if (!isset($this->customers[$id])) {
            return null;
        }

        return $this->customers[$id];
    }

    /**
     * {@inheritdoc}
     */
    public function persist(Customer $customer)
    {
        $this->add($customer);
    }

    /**
     * @param Customer $customer
     */
    public function add(Customer $customer)
    {
        $this->customers[$customer->id()->id()] = $customer;
    }
}