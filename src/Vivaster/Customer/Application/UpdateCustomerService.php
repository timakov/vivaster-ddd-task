<?php

namespace Vivaster\Customer\Application;

use Vivaster\Customer\Domain\Common\Address;
use Vivaster\Customer\Application\UpdateCustomerRequest;

/**
 * Class UpdateCustomerService
 */
final class UpdateCustomerService extends CustomerService
{
    /**
     * @param UpdateCustomerRequest $request
     *
     * @return array
     */
    public function execute(UpdateCustomerRequest $request)
    {
        $customer = $this->findCustomerOrFail($request->customerId());

        $changesApplied = false;

        $newName    = $request->name();
        $newCountry = $request->country();
        $newStreet  = $request->street();

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

        return $this->customerDataTransformer->transform($customer);
    }
}