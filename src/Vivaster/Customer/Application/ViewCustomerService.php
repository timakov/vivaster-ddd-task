<?php

namespace Vivaster\Customer\Application;

/**
 * Class ViewCustomerService
 */
final class ViewCustomerService extends CustomerService
{
    /**
     * @param ViewCustomerRequest $request
     * @return array
     */
    public function execute(ViewCustomerRequest $request)
    {
        $customer = $this->findCustomerOrFail($request->customerId());

        return [
            $customer->name(),
            $customer->address()->country(),
            $customer->address()->street(),
        ];
    }
}