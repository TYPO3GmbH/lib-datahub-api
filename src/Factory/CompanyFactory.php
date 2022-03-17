<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\Company;
use T3G\DatahubApiLibrary\Enum\CompanyType;

/**
 * @extends AbstractFactory<Company>
 */
class CompanyFactory extends AbstractFactory
{
    public static function fromArray(array $data): Company
    {
        $company = (new Company())
            ->setTitle($data['title'])
            ->setUuid($data['uuid'])
            ->setEmail($data['email'] ?? '')
            ->setVatId($data['vatId'] ?? '')
            ->setHubspotId($data['hubspotId'] ?? null)
            ->setDomain($data['domain'] ?? null)
            ->setCompanyType($data['companyType'] ?? CompanyType::AGENCY)
            ->setCity($data['city'] ?? null)
            ->setCountry($data['country']['iso'] ?? null)
            ->setBacklink($data['backlink'] ?? null)
            ->setTeaserText($data['teaserText'] ?? null)
            ->setProfilePageText($data['profilePageText'] ?? null)
            ->setContactFormAddress($data['contactFormAddress'] ?? null)
            ->setPhoto($data['photo'] ?? null)
            ->setLogo($data['logo'] ?? null)
            ->setHeadquarter(isset($data['headquarter']) ? AddressFactory::fromArray($data['headquarter']) : null)
            ->setFoundingPartner($data['foundingPartner'] ?? false)
            ->setPsl($data['psl'] ?? false);

        if (isset($data['slug'])) {
            $company->setSlug($data['slug']);
        }
        foreach ($data['mapLocations'] ?? [] as $mapLocation) {
            $company->addMapLocation(AddressFactory::fromArray($mapLocation));
        }
        foreach ($data['addresses'] ?? [] as $address) {
            $company->addAddress(AddressFactory::fromArray($address));
        }
        if (isset($data['membership'])) {
            $company->setMembership(SubscriptionFactory::fromArray($data['membership']));
        }
        foreach ($data['emailAddresses'] ?? [] as $emailAddress) {
            $company->addEmailAddress(EmailAddressFactory::fromArray($emailAddress));
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
        foreach ($data['voucherCodes'] ?? [] as $voucherCode) {
            $company->addVoucherCode(VoucherCodeFactory::fromArray($voucherCode));
        }
        foreach ($data['eltsPlans'] ?? [] as $eltsPlan) {
            $company->addEltsPlan(EltsPlanFactory::fromArray($eltsPlan));
        }
        foreach ($data['examAccesses'] ?? [] as $examAccess) {
            $company->addExamAccess(ExamAccessFactory::fromArray($examAccess));
        }

        return $company;
    }
}
