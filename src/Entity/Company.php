<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use T3G\DatahubApiLibrary\BitMask\EmailType;
use T3G\DatahubApiLibrary\Enum\CompanyService;
use T3G\DatahubApiLibrary\Enum\CompanyType;
use T3G\DatahubApiLibrary\Enum\EmployeeRole;
use T3G\DatahubApiLibrary\Enum\SubscriptionType;

class Company implements \JsonSerializable
{
    private string $uuid;
    private string $companyType = CompanyType::AGENCY;
    private string $title;
    private ?string $slug = null;
    private ?string $owner = null;
    private string $email;
    private ?string $vatId = null;
    private ?string $city = null;
    private ?string $country = null;
    private bool $foundingPartner = false;
    private ?bool $psl = null;

    /**
     * @var list<CompanyService::*>
     */
    private array $offeredServices = [];

    /**
     * @var array<string, mixed>
     */
    private array $status = [];

    /**
     * @var EmailAddress[]
     */
    private array $emailAddresses = [];

    /**
     * @var Address[]
     */
    private array $addresses = [];

    /**
     * @var Employee[]
     */
    private array $employees = [];

    /**
     * @var Order[]
     */
    private array $orders = [];

    /**
     * @var Subscription[]
     */
    private array $subscriptions = [];
    private ?Address $headquarter = null;
    private ?Subscription $partnerProgram = null;
    private ?Subscription $membership = null;
    private ?string $domain = null;
    private ?string $backlink = null;

    /**
     * @var Address[]
     */
    private array $mapLocations = [];
    private ?string $teaserText = null;
    private ?string $profilePageText = null;
    private ?string $contactFormAddress = null;
    private ?string $photo = null;
    private ?string $logo = null;

    /**
     * @var VoucherCode[]
     */
    private array $voucherCodes = [];

    /**
     * @var EltsPlan[]
     */
    private array $eltsPlans = [];

    /**
     * @var ExamAccess[]
     */
    private array $examAccesses = [];

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'companyType' => $this->getCompanyType(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'owner' => $this->getOwner(),
            'email' => $this->getEmail(),
            'vatId' => $this->getVatId(),
            'city' => $this->getCity(),
            'country' => $this->getCountry(),
            'domain' => $this->getDomain(),
            'backlink' => $this->getBacklink(),
            'mapLocations' => array_map(static function (Address $a) {
                return $a->getUuid();
            }, $this->getMapLocations()),
            'teaserText' => $this->getTeaserText(),
            'profilePageText' => $this->getProfilePageText(),
            'contactFormAddress' => $this->getContactFormAddress(),
            'photo' => $this->getPhoto(),
            'logo' => $this->getLogo(),
            'headquarter' => $this->getHeadquarter() instanceof Address ? $this->getHeadquarter()->getUuid() : null,
            'psl' => $this->isPsl(),
            'offeredServices' => $this->getOfferedServices(),
        ];
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return $this
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getCompanyType(): string
    {
        return $this->companyType;
    }

    /**
     * @return $this
     */
    public function setCompanyType(string $companyType): self
    {
        $this->companyType = $companyType;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @return $this
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    /**
     * @return $this
     */
    public function setOwner(?string $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPrimaryEmail(bool $onlyOptIn = true): ?string
    {
        return $this->getEmailByType(EmailType::PRIMARY, $onlyOptIn);
    }

    public function getBillingEmail(bool $onlyOptIn = true): ?string
    {
        return $this->getEmailByType(EmailType::BILLING, $onlyOptIn);
    }

    public function getVotingEmail(bool $onlyOptIn = true): ?string
    {
        return $this->getEmailByType(EmailType::VOTING, $onlyOptIn);
    }

    public function getEmailByType(int $type, bool $onlyOptIn = true): ?string
    {
        foreach ($this->getEmailAddresses() as $address) {
            if ($type === ($address->getType() & $type) && (null !== $address->getOptIn() || !$onlyOptIn)) {
                return $address->getEmail();
            }
        }

        return null;
    }

    /**
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getVatId(): ?string
    {
        return $this->vatId;
    }

    /**
     * @return $this
     */
    public function setVatId(?string $vatId): self
    {
        $this->vatId = $vatId;

        return $this;
    }

    /**
     * @return Address[]
     */
    public function getAddresses(): array
    {
        return $this->addresses;
    }

    /**
     * @param Address[] $addresses
     *
     * @return $this
     */
    public function setAddresses(array $addresses): self
    {
        $this->addresses = $addresses;

        return $this;
    }

    public function addAddress(Address $address): self
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * @return Employee[]
     */
    public function getEmployees(): array
    {
        return $this->employees;
    }

    /**
     * @param Employee[] $employees
     *
     * @return $this
     */
    public function setEmployees(array $employees): self
    {
        $this->employees = $employees;

        return $this;
    }

    public function getEmployee(string $username): ?Employee
    {
        foreach ($this->employees as $employee) {
            if (null !== $employee->getUser() && $username === $employee->getUser()->getUserName()) {
                return $employee;
            }
        }

        return null;
    }

    public function getEmployeeByUuid(string $uuid): ?Employee
    {
        foreach ($this->employees as $employee) {
            if ($uuid === $employee->getUuid()) {
                return $employee;
            }
        }

        return null;
    }

    /**
     * @return $this
     */
    public function addEmployee(Employee $employee): self
    {
        $this->employees[] = $employee;

        return $this;
    }

    /**
     * @return Order[]
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @param bool $ascending Set true for ascending order, false for descending order
     *
     * @return Order[]
     */
    public function getOrdersSortedByTime(bool $ascending = true): array
    {
        $o = $this->orders;
        usort($o, static function (Order $a, Order $b) {
            if ($a->getCreatedAt()->getTimestamp() === $b->getCreatedAt()->getTimestamp()) {
                return 0;
            }

            return $a->getCreatedAt() < $b->getCreatedAt() ? -1 : 1;
        });

        return $ascending ? $o : array_reverse($o);
    }

    /**
     * @param Order[] $orders
     *
     * @return $this
     */
    public function setOrders(array $orders): self
    {
        $this->orders = $orders;

        return $this;
    }

    /**
     * @return $this
     */
    public function addOrder(Order $order): self
    {
        $this->orders[] = $order;

        return $this;
    }

    /**
     * @return Subscription[]
     */
    public function getSubscriptions(): array
    {
        return $this->subscriptions;
    }

    /**
     * @return Subscription[]
     */
    public function getPslSubscriptions(): iterable
    {
        return new \ArrayIterator(array_filter(
            $this->subscriptions,
            static fn (Subscription $subscription) => SubscriptionType::PSL === $subscription->getSubscriptionType()
        ));
    }

    /**
     * @param Subscription[] $subscriptions
     *
     * @return $this
     */
    public function setSubscriptions(array $subscriptions): self
    {
        $this->subscriptions = $subscriptions;

        return $this;
    }

    /**
     * @return $this
     */
    public function addSubscription(Subscription $subscription): self
    {
        $this->subscriptions[] = $subscription;

        return $this;
    }

    public function getPartnerProgram(): ?Subscription
    {
        return $this->partnerProgram;
    }

    /**
     * @return $this
     */
    public function setPartnerProgram(?Subscription $partnerProgram): self
    {
        $this->partnerProgram = $partnerProgram;

        return $this;
    }

    public function getMembership(): ?Subscription
    {
        return $this->membership;
    }

    /**
     * @return $this
     */
    public function setMembership(?Subscription $membership): self
    {
        $this->membership = $membership;

        return $this;
    }

    public function __toString(): string
    {
        return $this->title;
    }

    public function isEmployee(string $username): bool
    {
        return $this->employeeHasRole($username, EmployeeRole::EMPLOYEE);
    }

    public function isManager(string $username): bool
    {
        return $this->employeeHasRole($username, EmployeeRole::MANAGER);
    }

    public function isOwner(string $username): bool
    {
        return $this->employeeHasRole($username, EmployeeRole::OWNER);
    }

    public function employeeHasRole(string $username, string $role): bool
    {
        foreach ($this->employees as $employee) {
            if ($role === $employee->getRole() && null !== $employee->getUser() && $username === $employee->getUser()->getUsername()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return Address[]
     */
    public function getInvoiceAddresses(): iterable
    {
        return new \ArrayIterator(array_values(array_filter($this->addresses, static function (Address $address) {
            return $address->isInvoiceAddress();
        })));
    }

    /**
     * @return Address[]
     */
    public function getPostalAddresses(): iterable
    {
        return new \ArrayIterator(array_values(array_filter($this->addresses, static function (Address $address) {
            return $address->isPostalAddress();
        })));
    }

    /**
     * @return Address[]
     */
    public function getDeliveryAddresses(): iterable
    {
        return new \ArrayIterator(array_values(array_filter($this->addresses, static function (Address $address) {
            return $address->isDeliveryAddress();
        })));
    }

    /**
     * @return Address[]
     */
    public function getLocationAddresses(): iterable
    {
        return new \ArrayIterator(array_values(array_filter($this->addresses, static function (Address $address) {
            return $address->isLocationAddress();
        })));
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @return $this
     */
    public function setDomain(?string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return $this
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return $this
     */
    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getBacklink(): ?string
    {
        return $this->backlink;
    }

    /**
     * @return $this
     */
    public function setBacklink(?string $backlink): self
    {
        $this->backlink = $backlink;

        return $this;
    }

    /**
     * @return Address[]
     */
    public function getMapLocations(): array
    {
        return $this->mapLocations;
    }

    /**
     * @param Address[] $mapLocations
     *
     * @return $this
     */
    public function setMapLocations(array $mapLocations): self
    {
        $this->mapLocations = $mapLocations;

        return $this;
    }

    /**
     * @return $this
     */
    public function addMapLocation(Address $mapLocation): self
    {
        $this->mapLocations[] = $mapLocation;

        return $this;
    }

    public function getTeaserText(): ?string
    {
        return $this->teaserText;
    }

    /**
     * @return $this
     */
    public function setTeaserText(?string $teaserText): self
    {
        $this->teaserText = $teaserText;

        return $this;
    }

    public function getProfilePageText(): ?string
    {
        return $this->profilePageText;
    }

    /**
     * @return $this
     */
    public function setProfilePageText(?string $profilePageText): self
    {
        $this->profilePageText = $profilePageText;

        return $this;
    }

    public function getContactFormAddress(): ?string
    {
        return $this->contactFormAddress;
    }

    /**
     * @return $this
     */
    public function setContactFormAddress(?string $contactFormAddress): self
    {
        $this->contactFormAddress = $contactFormAddress;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @return $this
     */
    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * @return $this
     */
    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getHeadquarter(): ?Address
    {
        return $this->headquarter;
    }

    /**
     * @return $this
     */
    public function setHeadquarter(?Address $headquarter): self
    {
        $this->headquarter = $headquarter;

        return $this;
    }

    public function isFoundingPartner(): bool
    {
        return $this->foundingPartner;
    }

    /**
     * @return $this
     */
    public function setFoundingPartner(bool $foundingPartner): self
    {
        $this->foundingPartner = $foundingPartner;

        return $this;
    }

    public function isPsl(): ?bool
    {
        return $this->psl;
    }

    /**
     * @return $this
     */
    public function setPsl(?bool $psl): self
    {
        $this->psl = $psl;

        return $this;
    }

    /**
     * @return list<CompanyService::*>
     */
    public function getOfferedServices(): array
    {
        return $this->offeredServices;
    }

    /**
     * @param list<CompanyService::*> $offeredServices
     *
     * @return $this
     */
    public function setOfferedServices(array $offeredServices): self
    {
        $this->offeredServices = array_values($offeredServices);

        return $this;
    }

    /**
     * @return EmailAddress[]
     */
    public function getEmailAddresses(): array
    {
        return $this->emailAddresses;
    }

    /**
     * @param EmailAddress[] $emailAddresses
     *
     * @return $this
     */
    public function setEmailAddresses(array $emailAddresses): self
    {
        $this->emailAddresses = $emailAddresses;

        return $this;
    }

    /**
     * @return $this
     */
    public function addEmailAddress(EmailAddress $emailAddress): self
    {
        $this->emailAddresses[] = $emailAddress;

        return $this;
    }

    /**
     * @return VoucherCode[]
     */
    public function getVoucherCodes(): array
    {
        return $this->voucherCodes;
    }

    /**
     * @param VoucherCode[] $voucherCodes
     *
     * @return $this
     */
    public function setVoucherCodes(array $voucherCodes): self
    {
        $this->voucherCodes = $voucherCodes;

        return $this;
    }

    /**
     * @return $this
     */
    public function addVoucherCode(VoucherCode $voucherCode): self
    {
        $this->voucherCodes[] = $voucherCode;

        return $this;
    }

    /**
     * @return EltsPlan[]
     */
    public function getEltsPlans(): array
    {
        return $this->eltsPlans;
    }

    /**
     * @param EltsPlan[] $eltsPlans
     *
     * @return $this
     */
    public function setEltsPlans(array $eltsPlans): self
    {
        $this->eltsPlans = $eltsPlans;

        return $this;
    }

    /**
     * @return $this
     */
    public function addEltsPlan(EltsPlan $eltsPlan): self
    {
        $this->eltsPlans[] = $eltsPlan;

        return $this;
    }

    /**
     * @return ExamAccess[]
     */
    public function getExamAccesses(): array
    {
        return $this->examAccesses;
    }

    /**
     * @param ExamAccess[] $examAccesses
     *
     * @return $this
     */
    public function setExamAccesses(array $examAccesses): self
    {
        $this->examAccesses = $examAccesses;

        return $this;
    }

    /**
     * @return $this
     */
    public function addExamAccess(ExamAccess $examAccess): self
    {
        $this->examAccesses[] = $examAccess;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getStatus(): array
    {
        return $this->status;
    }

    /**
     * @param array<string, mixed> $status
     */
    public function setStatus(array $status): Company
    {
        $this->status = $status;

        return $this;
    }
}
