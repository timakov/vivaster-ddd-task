<?php

namespace Vivaster\Customer\Infrastructure\Delivery\API\Controller;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\Response;
use Vivaster\Customer\Infrastructure\Persistence\InMemoryCustomerRepository;
use Vivaster\Customer\Application\ViewCustomerService;
use Vivaster\Customer\Application\ViewCustomerRequest;
use Vivaster\Customer\Application\UpdateCustomerService;
use Vivaster\Customer\Application\UpdateCustomerRequest;
use Vivaster\Customer\Application\DataTransformer\CustomerJsonDataTransformer;

final class CustomerController implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function getAction($customerId)
    {
        return new Response(
            $this->container->get('customer.app.action.view')->execute(
                new ViewCustomerRequest($customerId)
            )
        );
    }

    public function patchAction($customerId)
    {
        parse_str(file_get_contents('php://input'), $data);

        return new Response(
            $this->container->get('customer.app.action.update')->execute(
                new UpdateCustomerRequest($customerId, $data)
            )
        );
    }
}