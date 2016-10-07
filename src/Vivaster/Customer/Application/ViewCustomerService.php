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
        return $this->customerDataTransformer->transform(
            $this->findCustomerOrFail($request->customerId())
        );
    }
}