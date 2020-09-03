<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\Company;
use T3G\DatahubApiLibrary\Enum\CompanyType;

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
            ->setVatId($data['vatId'] ?? '')
            ->setDomain($data['domain'] ?? null)
            ->setCompanyType($data['companyType'] ?? CompanyType::AGENCY)
            ->setCity($data['city'] ?? null)
            ->setCountry($data['country']['iso'] ?? null)
            ->setBacklink($data['backlink'] ?? null)
            ->setMapLocations($data['mapLocations'] ?? [])
            ->setProfilePageText($data['profilePageText'] ?? null)
            ->setContactFormAddress($data['contactFormAddress'] ?? null)
            ->setPhoto($data['photo'] ?? null)
            ->setLogo($data['logo'] ?? null);

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
        foreach ($data['subscriptions'] ?? [] as $subscription) {
            $company->addSubscription(SubscriptionFactory::fromArray($subscription));
        }

        return $company;
    }
}
