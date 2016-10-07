<?php

namespace Vivaster\Customer\Infrastructure\Delivery\API\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Vivaster\Customer\Infrastructure\Persistence\InMemoryCustomerRepository;
use Vivaster\Customer\Application\ViewCustomerService;
use Vivaster\Customer\Application\UpdateCustomerService;

class CustomerController
{
    public function getAction($customerId)
    {
        return new JsonResponse(
            (new ViewCustomerService(new InMemoryCustomerRepository()))->execute($customerId)
        );
    }

    public function patchAction($customerId)
    {
        parse_str(file_get_contents('php://input'), $data);

        return new JsonResponse(
            (new UpdateCustomerService(new InMemoryCustomerRepository()))->execute($customerId, $data)
        );
    }
}