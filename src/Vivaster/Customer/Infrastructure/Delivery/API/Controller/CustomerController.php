<?php

namespace Vivaster\Customer\Infrastructure\Delivery\API\Controller;

use Symfony\Component\HttpFoundation\Response;
use Vivaster\Customer\Infrastructure\Persistence\InMemoryCustomerRepository;
use Vivaster\Customer\Application\ViewCustomerService;
use Vivaster\Customer\Application\ViewCustomerRequest;
use Vivaster\Customer\Application\UpdateCustomerService;
use Vivaster\Customer\Application\UpdateCustomerRequest;
use Vivaster\Customer\Application\DataTransformer\CustomerJsonDataTransformer;

final class CustomerController
{
    public function getAction($customerId)
    {
        return new Response(
            (
                new ViewCustomerService(
                    new InMemoryCustomerRepository(),
                    new CustomerJsonDataTransformer()
                )
            )->execute(
                new ViewCustomerRequest($customerId)
            )
        );
    }

    public function patchAction($customerId)
    {
        parse_str(file_get_contents('php://input'), $data);

        return new Response(
            (
                new UpdateCustomerService(
                    new InMemoryCustomerRepository(),
                    new CustomerJsonDataTransformer()
                )
            )->execute(
                new UpdateCustomerRequest($customerId, $data)
            )
        );
    }
}