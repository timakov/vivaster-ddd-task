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

        $this->customerDataTransformer->write($customer);

        return $this->customerDataTransformer->read();
    }
}