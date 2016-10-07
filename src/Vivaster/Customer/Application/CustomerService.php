<?php

namespace Vivaster\Customer\Application;

use Vivaster\Customer\Domain\Model\Customer\CustomerRepository;
use Vivaster\Customer\Domain\Model\Customer\Customer;
use Vivaster\Customer\Domain\Model\Customer\CustomerId;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CustomerService
 */
abstract class CustomerService
{
    /**
     * @var CustomerRepository;
     */
    protected $customerRepository;

    /**
     * CustomerService constructor.
     *
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param string $customerId
     * @return Customer
     * @throws NotFoundHttpException
     */
    public function findCustomerOrFail($customerId)
    {
        $customer = $this->customerRepository->ofId(new CustomerId($customerId));

        if (!$customer) {
            throw new NotFoundHttpException('Customer not found');
        }

        return $customer;
    }
}