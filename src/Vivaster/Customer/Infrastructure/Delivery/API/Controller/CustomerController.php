<?php
namespace Vivaster\Customer\Infrastructure\Delivery\API\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Vivaster\Customer\Infrastructure\Persistence\InMemoryCustomerRepository;
use Vivaster\Customer\Domain\Model\Customer\Customer;
use Vivaster\Customer\Domain\Common\Address;
use Vivaster\Customer\Domain\Model\Customer\CustomerId;

class CustomerController
{
    private $repo;

    public function __construct()
    {
        $this->repo = new InMemoryCustomerRepository();

        $this->repo->add(new Customer(new CustomerId(1), 'Ivan',    new Address('RU', 'qwe')));
        $this->repo->add(new Customer(new CustomerId(2), 'Olesia',  new Address('UA', 'asd')));
        $this->repo->add(new Customer(new CustomerId(3), 'Johnny',  new Address('US', 'zxc')));
    }

    public function getAction($customerId)
    {
        $customer = $this->repo->ofId(new CustomerId($customerId));

        if (!$customer) {
            throw new NotFoundHttpException();
        }

        return new JsonResponse([
            $customer->name(),
            $customer->address()->country(),
            $customer->address()->street(),
        ]);
    }

    public function patchAction($customerId)
    {
        $customer = $this->repo->ofId(new CustomerId($customerId));

        if (!$customer) {
            throw new NotFoundHttpException();
        }

        $changesApplied = false;

        parse_str(file_get_contents('php://input'), $data);

        $newName    = isset($data['name']) ? $data['name'] : null;
        $newCountry = isset($data['country']) ? $data['country'] : null;
        $newStreet  = isset($data['street']) ? $data['street'] : null;

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
            $this->repo->persist($customer);
        }

        return new JsonResponse([
            $customer->name(),
            $customer->address()->country(),
            $customer->address()->street(),
        ]);
    }
}