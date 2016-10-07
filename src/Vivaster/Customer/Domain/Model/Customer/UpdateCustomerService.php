<?php

namespace Vivaster\Customer\Domain\Model\Customer;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Vivaster\Customer\Domain\Common\Address;

/**
 * Class UpdateCustomerService
 */
class UpdateCustomerService
{
    /**
     * @var CustomerRepository;
     */
    private $customerRepository;

    /**
     * UpdateCustomerService constructor.
     *
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param string $customerId
     * @param array $data
     *
     * @return array
     */
    public function execute($customerId, array $data)
    {
        $customer = $this->customerRepository->ofId(new CustomerId($customerId));

        if (!$customer) {
            throw new NotFoundHttpException('Customer not found');
        }

        $changesApplied = false;

        $newName    = isset($data['name'])    ? $data['name'] : null;
        $newCountry = isset($data['country']) ? $data['country'] : null;
        $newStreet  = isset($data['street'])  ? $data['street'] : null;

        if (isset($newName)) {
            if ($customer->rename($newName)) {
                $changesApplied = true;
            }
        }

        if (isset($newCountry) || isset($newStreet)) {
            if (!isset($newCountry)) {
                $newCountry = $customer->address()->country();
            }

            if (!isset($newStreet)) {
                $newStreet = $customer->address()->street();
            }

            if ($customer->move(new Address($newCountry, $newStreet))) {
                $changesApplied = true;
            }
        }

        if ($changesApplied) {
            $this->customerRepository->persist($customer);
        }

        return [
            $customer->name(),
            $customer->address()->country(),
            $customer->address()->street(),
        ];
    }
}