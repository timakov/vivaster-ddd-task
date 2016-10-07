<?php

namespace Vivaster\Customer\Infrastructure\Persistence;

use Vivaster\Customer\Domain\Model\Customer\Customer;
use Vivaster\Customer\Domain\Model\Customer\CustomerRepository;

class InMemoryCustomerRepository implements CustomerRepository
{
    /**
     * @var Customer[]
     */
    private $customers = [];

    public function ofId($customerId)
    {
        if (!isset($this->customers[$customerId])) {
            return null;
        }

        return $this->customers[$customerId];
    }

    public function save(Customer $customer)
    {
        $this->add($customer);
    }

    public function add(Customer $customer)
    {
        $this->customers[$customer->id()] = $customer;
    }
}