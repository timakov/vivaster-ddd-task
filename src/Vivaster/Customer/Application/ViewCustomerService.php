<?php

namespace Vivaster\Customer\Application;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Vivaster\Customer\Domain\Model\Customer\CustomerRepository;
use Vivaster\Customer\Domain\Model\Customer\CustomerId;

/**
 * Class ViewCustomerService
 */
class ViewCustomerService
{
    /**
     * @var CustomerRepository;
     */
    private $customerRepository;

    /**
     * ViewCustomerService constructor.
     *
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param string $customerId
     * @return array
     */
    public function execute($customerId)
    {
        $customer = $this->customerRepository->ofId(new CustomerId($customerId));

        if (!$customer) {
            throw new NotFoundHttpException('Customer not found');
        }

        return [
            $customer->name(),
            $customer->address()->country(),
            $customer->address()->street(),
        ];
    }
}