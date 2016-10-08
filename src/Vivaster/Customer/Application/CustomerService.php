<?php

namespace Vivaster\Customer\Application;

use Vivaster\Customer\Domain\Model\Customer\CustomerRepository;
use Vivaster\Customer\Domain\Model\Customer\Customer;
use Vivaster\Customer\Domain\Model\Customer\CustomerId;
use Vivaster\Customer\Application\DataTransformer\CustomerDataTransformer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

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
     * @var CustomerDataTransformer
     */
    protected $customerDataTransformer;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * CustomerService constructor.
     *
     * @param CustomerRepository $customerRepository
     * @param CustomerDataTransformer $customerDataTransformer
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        CustomerRepository $customerRepository,
        CustomerDataTransformer $customerDataTransformer,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->customerRepository       = $customerRepository;
        $this->customerDataTransformer  = $customerDataTransformer;
        $this->eventDispatcher          = $eventDispatcher;
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