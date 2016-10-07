<?php

namespace Vivaster\Customer\Application;

use Vivaster\Customer\Domain\Common\Address;

/**
 * Class UpdateCustomerService
 */
final class UpdateCustomerService extends CustomerService
{
    /**
     * @param string $customerId
     * @param array $data
     *
     * @return array
     */
    public function execute($customerId, array $data)
    {
        $customer = $this->findCustomerOrFail($customerId);

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