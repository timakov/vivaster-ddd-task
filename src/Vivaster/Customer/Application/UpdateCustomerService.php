<?php

namespace Vivaster\Customer\Application;

use Vivaster\Customer\Domain\Common\Address;
use Vivaster\Customer\Application\Event\CustomerRenamedEvent;
use Vivaster\Customer\Application\Event\CustomerMovedEvent;

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

        $changesApplied = $customerRenamed = $customerRelocated = false;

        $newName    = $request->name();
        $oldName    = $customer->name();

        $newCountry = $request->country();
        $newStreet  = $request->street();
        $oldAddress = $customer->address();

        if (isset($newName)) {
            if ($customer->rename($newName)) {
                $customerRenamed = $changesApplied = true;
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
                $customerRelocated = $changesApplied = true;
            }
        }

        if ($changesApplied) {
            $this->customerRepository->persist($customer);
        }

        if ($customerRenamed) {
            $this->eventDispatcher->dispatch(
                CustomerRenamedEvent::EVENT_NAME,
                new CustomerRenamedEvent(
                    $customer->id(),
                    $oldName,
                    $customer->name()
                )
            );
        }

        if ($customerRelocated) {
            $this->eventDispatcher->dispatch(
                CustomerMovedEvent::EVENT_NAME,
                new CustomerMovedEvent(
                    $customer->id(),
                    $oldAddress,
                    $customer->address()
                )
            );
        }

        return $this->customerDataTransformer->transform($customer);
    }
}