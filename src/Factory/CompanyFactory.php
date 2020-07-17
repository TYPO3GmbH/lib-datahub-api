<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\Company;

class CompanyFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): Company
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    public static function fromArray(array $data): Company
    {
        $company = (new Company())
            ->setTitle($data['title'])
            ->setUuid($data['uuid'])
            ->setEmail($data['email'] ?? '')
            ->setVatId($data['vatId'] ?? '');

        foreach ($data['addresses'] ?? [] as $address) {
            $company->addAddress(AddressFactory::fromArray($address));
        }
        if (isset($data['membership'])) {
            $company->setMembership(MembershipFactory::fromArray($data['membership']));
        }
        foreach ($data['employees'] ?? [] as $employee) {
            $company->addEmployee(EmployeeFactory::fromArray($employee));
        }
        foreach ($data['orders'] ?? [] as $order) {
            $company->addOrder(OrderFactory::fromArray($order));
        }

        return $company;
    }
}
